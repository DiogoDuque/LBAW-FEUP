/*ENUMS*/
CREATE TYPE privilegeLevel AS ENUM ('Member', 'Moderator', 'Administrator');

CREATE TYPE reportType AS ENUM ('DuplicateQuestion', 'LackOfClarity', 'InnapropriateLanguage', 'BadBehavior');

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
  hashed_pass CHAR(32) NOT NULL,
  privilege_level privilegeLevel DEFAULT 'Member' NOT NULL,
  reputation INT DEFAULT 0 NOT NULL,
  image_id INT,
  creation_date DATE NOT NULL,
  category_ids INT[],
  CONSTRAINT member_image_id_fk FOREIGN KEY (image_id) REFERENCES public.image (id)
);
CREATE UNIQUE INDEX member_username_uindex ON public.member (username);
CREATE UNIQUE INDEX member_email_uindex ON public.member (email);

CREATE TABLE public.post
(
  id SERIAL PRIMARY KEY,
  creation_date DATE DEFAULT current_date NOT NULL,
  up_votes INT NOT NULL,
  down_votes INT NOT NULL,
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
  report_type reportType NOT NULL,
  creator_id INT NOT NULL,
  post_id INT,
  CONSTRAINT report_member_id_fk FOREIGN KEY (creator_id) REFERENCES public.member (id),
  CONSTRAINT report_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id)
);


CREATE TABLE public.question
(
  post_id INT PRIMARY KEY,
  title TEXT NOT NULL,
  view_count INT NOT NULL,
  answer_count INT NOT NULL,
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

CREATE TABLE public.promotionDemontion
(
  id SERIAL PRIMARY KEY,
  date DATE DEFAULT current_date NOT NULL,
  privilege_level privilegeLevel NOT NULL,
  member_id INT NOT NULL,
  admin_id INT NOT NULL,
  CONSTRAINT promotionDemontion_member_id_fk FOREIGN KEY (member_id) REFERENCES public.member (id),
  CONSTRAINT promotionDemontion_admin_id_fk FOREIGN KEY (admin_id) REFERENCES public.member (id)
);

/*TRIGGERS*/

CREATE FUNCTION check_admin_previleges_f()
  RETURNS trigger AS $$
BEGIN
  IF((
       SELECT previlege_level
       FROM member
       WHERE member.id = NEW.admin_id
     ) <> 'Administrator'::privilegeLevel) THEN
    RAISE EXCEPTION 'No Permission';
  END IF;

END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_admin_previleges_tr
BEFORE INSERT OR UPDATE
  ON promotiondemontion
FOR EACH ROW
EXECUTE PROCEDURE check_admin_previleges_f();

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
  new.text='lalala';
  RETURN new;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER update_mod_date_tr
AFTER UPDATE
  ON comment
FOR EACH ROW
EXECUTE PROCEDURE update_comment_mod_date_f();
