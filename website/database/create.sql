DROP SCHEMA public CASCADE;
CREATE SCHEMA public;

-- GRANT ALL ON SCHEMA public TO postgres;
-- GRANT ALL ON SCHEMA public TO public;

/*ENUMS*/
CREATE TYPE PrivilegeLevel AS ENUM ('Member', 'Moderator', 'Administrator');

CREATE TYPE ReportType AS ENUM ('DuplicateQuestion', 'LackOfClarity', 'InnapropriateLanguage', 'BadBehavior');

/*TABLES*/

CREATE TABLE public.image
(
  id SERIAL PRIMARY KEY,
  filename VARCHAR(50) NOT NULL
);
CREATE UNIQUE INDEX image_filename_uindex ON public.image (filename);

CREATE TABLE public.category
(
  id SERIAL PRIMARY KEY,
  name VARCHAR(20) NOT NULL
);
CREATE UNIQUE INDEX category_name_uindex ON public.category (name);

CREATE TABLE public.member
(
  id SERIAL PRIMARY KEY,
  username VARCHAR(20) NOT NULL,
  email VARCHAR(254) NOT NULL,
  hashed_pass CHAR(64) NOT NULL,
  privilege_level PrivilegeLevel DEFAULT 'Member' NOT NULL,
  reputation INT DEFAULT 0 NOT NULL,
  image_id INT,
  creation_date DATE DEFAULT current_date NOT NULL,
  category_ids INT[],
  CONSTRAINT member_image_id_fk FOREIGN KEY (image_id) REFERENCES public.image (id)
);
CREATE UNIQUE INDEX member_username_uindex ON public.member (username);
CREATE UNIQUE INDEX member_email_uindex ON public.member (email);

CREATE TABLE public.post
(
  id SERIAL PRIMARY KEY,
  creation_date DATE DEFAULT current_date NOT NULL,
  up_votes INT DEFAULT 0 NOT NULL,
  down_votes INT DEFAULT 0 NOT NULL,
  author_id INT NOT NULL,
  image_ids INT[],
  CONSTRAINT post_member_id_fk FOREIGN KEY (author_id) REFERENCES public.member (id)
);

CREATE TABLE public.vote
(
  post_id INT,
  member_id INT,
  value BOOLEAN NOT NULL,
  creation_date DATE DEFAULT current_date NOT NULL,
  CONSTRAINT vote_post_id_member_id_pk PRIMARY KEY (post_id, member_id),
  CONSTRAINT vote_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id),
  CONSTRAINT vote_member_id_fk FOREIGN KEY (member_id) REFERENCES public.member (id)
);

CREATE TABLE public.comment
(
  id SERIAL PRIMARY KEY,
  post_id INT NOT NULL,
  member_id INT NOT NULL,
  text TEXT NOT NULL,
  creation_date DATE DEFAULT current_date NOT NULL,
  last_modification_date DATE DEFAULT current_date NOT NULL,
  CONSTRAINT comment_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id),
  CONSTRAINT comment_member_id_fk FOREIGN KEY (member_id) REFERENCES public.member (id)
);


CREATE TABLE public.report
(
  id SERIAL PRIMARY KEY,
  description TEXT NOT NULL,
  creation_date DATE DEFAULT current_date NOT NULL,
  report_type ReportType NOT NULL,
  creator_id INT NOT NULL,
  post_id INT,
  CONSTRAINT report_member_id_fk FOREIGN KEY (creator_id) REFERENCES public.member (id),
  CONSTRAINT report_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id)
);


CREATE TABLE public.question
(
  post_id INT PRIMARY KEY,
  title TEXT NOT NULL,
  view_count INT DEFAULT 0 NOT NULL,
  answer_count INT DEFAULT 0 NOT NULL,
  category_id INT NOT NULL,
  CONSTRAINT answer_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id)
);


CREATE TABLE public.answer
(
  post_id INT PRIMARY KEY,
  correct BOOLEAN DEFAULT FALSE  NOT NULL,
  question_id INT NOT NULL,
  CONSTRAINT answer_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id),
  CONSTRAINT answer_question_post_id_fk FOREIGN KEY (question_id) REFERENCES public.question (post_id)
);

CREATE TABLE public.version
(
  id SERIAL PRIMARY KEY,
  text TEXT NOT NULL,
  date DATE DEFAULT current_date NOT NULL,
  post_id INT NOT NULL,
  member_id INT NOT NULL,
  CONSTRAINT version_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id),
  CONSTRAINT version_member_id_fk FOREIGN KEY (member_id) REFERENCES public.member (id)
);

CREATE TABLE public.promotionDemotion
(
  id SERIAL PRIMARY KEY,
  date DATE DEFAULT current_date NOT NULL,
  privilege_level PrivilegeLevel NOT NULL,
  member_id INT NOT NULL,
  admin_id INT NOT NULL,
  CONSTRAINT promotionDemotion_member_id_fk FOREIGN KEY (member_id) REFERENCES public.member (id),
  CONSTRAINT promotionDemotion_admin_id_fk FOREIGN KEY (admin_id) REFERENCES public.member (id)
);

/*TRIGGERS*/

CREATE FUNCTION check_admin_privileges_f()
  RETURNS trigger AS $$
BEGIN
  IF((
       SELECT privilege_level
       FROM member
       WHERE member.id = NEW.admin_id
     ) <> 'Administrator':: PrivilegeLevel) THEN
    RAISE EXCEPTION 'No Permission';
  END IF;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_admin_privileges_tr
BEFORE INSERT OR UPDATE
  ON promotiondemotion
FOR EACH ROW
EXECUTE PROCEDURE check_admin_privileges_f();

CREATE FUNCTION update_vote_in_post_f() RETURNS TRIGGER AS $BODY$
DECLARE
  down_vote INT;
  up_vote INT;
BEGIN
  IF(TG_OP = 'INSERT') THEN --INSERT
    IF(NEW.value) THEN
      up_vote=1;
      down_vote=0;
    ELSE
      up_vote=0;
      down_vote=1;
    END IF;

  ELSIF(TG_OP = 'UPDATE') THEN --UPDATE
    IF(NEW.value) THEN
      up_vote=1;
      down_vote=-1;
    ELSE
      up_vote=-1;
      down_vote=1;
    END IF;

  ELSEIF (OLD.value) THEN --DELETE
    up_vote=-1;
    down_vote=0;
  ELSE
    up_vote=0;
    down_vote=-1;
  END IF;

  --UPDATE POST ACCORDINGLY
  IF TG_OP='DELETE' THEN
    UPDATE post SET up_votes=up_votes+up_vote, down_votes=down_votes+down_vote
    WHERE post.id=OLD.post_id;
  ELSE
    UPDATE post SET up_votes=up_votes+up_vote, down_votes=down_votes+down_vote
    WHERE post.id=NEW.post_id;
  END IF;

  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER update_vote_in_post_tr
AFTER INSERT OR UPDATE OR DELETE
  ON vote
FOR EACH ROW
EXECUTE PROCEDURE update_vote_in_post_f();

CREATE FUNCTION update_comment_mod_date_f() RETURNS TRIGGER AS $BODY$
BEGIN
  new.last_modification_date=current_timestamp;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER update_mod_date_tr
AFTER UPDATE
  ON comment
FOR EACH ROW
EXECUTE PROCEDURE update_comment_mod_date_f();

--update answer_count

CREATE FUNCTION update_question_answer_count_f() RETURNS TRIGGER AS $BODY$
BEGIN
    IF(TG_OP = 'INSERT') THEN --INSERT
      IF(NEW.answer_post_id_fk) THEN
        answer_count=answer_count+1;
      END IF;

    ELSEIF(TG_OP = 'DELETE') THEN
      IF(OLD.answer_post_id_fk) THEN
        answer_count=answer_count-1;
      END IF;

    END IF;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER update_question_answer_count_tr
BEFORE INSERT OR DELETE
  ON question
FOR EACH ROW
EXECUTE PROCEDURE update_question_answer_count_f();

-- Update user reputation base on votes on his posts

CREATE FUNCTION update_reputation_f() RETURNS TRIGGER AS $BODY$

DECLARE
  repChange INT;

BEGIN
  IF(TG_OP = 'INSERT') THEN
    IF(NEW.value) THEN
      repChange = 1;
    ELSE
      repChange = -1;
    END IF;

    UPDATE member AS m
      SET reputation=reputation+repChange
    FROM post AS p JOIN vote AS v ON p.id = NEW.post_id
    WHERE m.id = p.author_id;

    ELSE
      IF(NEW.value) THEN
        repChange = -1;
      ELSE
        repChange = 1;
      END IF;

      UPDATE member AS m
      SET reputation=reputation+repChange
      FROM post AS p JOIN vote AS v ON p.id = NEW.post_id
      WHERE m.id = p.author_id;

  END IF;

  RETURN NEW;

END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER update_reputation_tr
BEFORE INSERT OR DELETE
  ON vote
FOR EACH ROW
EXECUTE PROCEDURE update_reputation_f();

-- Update the promoted member's privilege_level

CREATE FUNCTION update_member_privilege_f() RETURNS TRIGGER AS $BODY$
BEGIN
  UPDATE member
    SET privilege_level = NEW.privilege_level
    WHERE member.id = NEW.member_id;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER update_member_privilege_tr
AFTER INSERT
  ON promotiondemotion
FOR EACH ROW
EXECUTE PROCEDURE update_member_privilege_f();

/* INDEXES */

CREATE INDEX category_id_index ON category (id);
CREATE INDEX member_id_index ON member (id);
CREATE INDEX post_id_index ON post (id);
CREATE INDEX answer_post_id_index ON answer (post_id);
CREATE INDEX question_post_id_index ON question (post_id);
CREATE INDEX promotionDemotion_id_index ON category (id);
CREATE INDEX report_id_index ON report (id)