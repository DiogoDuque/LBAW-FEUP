DROP SCHEMA public CASCADE;
CREATE SCHEMA public;

-- GRANT ALL ON SCHEMA public TO postgres;
-- GRANT ALL ON SCHEMA public TO public;

/*ENUMS*/
CREATE TYPE PRIVILEGELEVEL AS ENUM ('Member', 'Moderator', 'Administrator');

CREATE TYPE REPORTTYPE AS ENUM ('DuplicateQuestion', 'LackOfClarity', 'InnapropriateLanguage', 'BadBehavior');

/*TABLES*/

CREATE TABLE public.image
(
  id       SERIAL PRIMARY KEY,
  filename VARCHAR(50) NOT NULL
);
CREATE UNIQUE INDEX image_filename_uindex
  ON public.image (filename);

CREATE TABLE public.category
(
  id   SERIAL PRIMARY KEY,
  name VARCHAR(20) NOT NULL
);
CREATE UNIQUE INDEX category_name_uindex
  ON public.category (name);

CREATE TABLE public.member
(
  id              SERIAL PRIMARY KEY,
  username        VARCHAR(20)                         NOT NULL,
  email           VARCHAR(254)                        NOT NULL,
  hashed_pass     CHAR(64)                            NOT NULL,
  privilege_level PRIVILEGELEVEL DEFAULT 'Member'     NOT NULL,
  reputation      INT DEFAULT 0                       NOT NULL,
  image_id        INT,
  creation_date   TIMESTAMP DEFAULT current_timestamp NOT NULL,
  category_ids    INT [],
  CONSTRAINT member_image_id_fk FOREIGN KEY (image_id) REFERENCES public.image (id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE UNIQUE INDEX member_username_uindex
  ON public.member (username);
CREATE UNIQUE INDEX member_email_uindex
  ON public.member (email);

CREATE TABLE public.post
(
  id            SERIAL PRIMARY KEY,
  creation_date TIMESTAMP DEFAULT current_timestamp NOT NULL,
  up_votes      INT DEFAULT 0                       NOT NULL,
  down_votes    INT DEFAULT 0                       NOT NULL,
  author_id     INT                                 NOT NULL,
  image_ids     INT [],
  CONSTRAINT post_member_id_fk FOREIGN KEY (author_id) REFERENCES public.member (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE public.vote
(
  post_id       INT,
  member_id     INT,
  value         BOOLEAN                             NOT NULL,
  creation_date TIMESTAMP DEFAULT current_timestamp NOT NULL,
  CONSTRAINT vote_post_id_member_id_pk PRIMARY KEY (post_id, member_id),
  CONSTRAINT vote_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT vote_member_id_fk FOREIGN KEY (member_id) REFERENCES public.member (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE public.comment
(
  id                     SERIAL PRIMARY KEY,
  post_id                INT                                 NOT NULL,
  member_id              INT                                 NOT NULL,
  text                   TEXT                                NOT NULL,
  creation_date          TIMESTAMP DEFAULT current_timestamp NOT NULL,
  last_modification_date TIMESTAMP DEFAULT current_timestamp NOT NULL,
  CONSTRAINT comment_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT comment_member_id_fk FOREIGN KEY (member_id) REFERENCES public.member (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE public.report
(
  id            SERIAL PRIMARY KEY,
  description   TEXT                                NOT NULL,
  creation_date TIMESTAMP DEFAULT current_timestamp NOT NULL,
  report_type   REPORTTYPE                          NOT NULL,
  creator_id    INT                                 NOT NULL,
  post_id       INT,
  CONSTRAINT report_member_id_fk FOREIGN KEY (creator_id) REFERENCES public.member (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT report_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE public.question
(
  post_id      INT PRIMARY KEY,
  title        TEXT          NOT NULL,
  view_count   INT DEFAULT 0 NOT NULL,
  answer_count INT DEFAULT 0 NOT NULL,
  category_id  INT           NOT NULL,
  CONSTRAINT answer_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE public.answer
(
  post_id     INT PRIMARY KEY,
  correct     BOOLEAN DEFAULT FALSE  NOT NULL,
  question_id INT                    NOT NULL,
  CONSTRAINT answer_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT answer_question_post_id_fk FOREIGN KEY (question_id) REFERENCES public.question (post_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE public.version
(
  id        SERIAL PRIMARY KEY,
  text      TEXT                                NOT NULL,
  date      TIMESTAMP DEFAULT current_timestamp NOT NULL,
  post_id   INT                                 NOT NULL,
  member_id INT                                 NOT NULL,
  CONSTRAINT version_post_id_fk FOREIGN KEY (post_id) REFERENCES public.post (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT version_member_id_fk FOREIGN KEY (member_id) REFERENCES public.member (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE public.promotionDemotion
(
  id              SERIAL PRIMARY KEY,
  date            TIMESTAMP DEFAULT current_timestamp NOT NULL,
  privilege_level PRIVILEGELEVEL                      NOT NULL,
  member_id       INT                                 NOT NULL,
  admin_id        INT                                 NOT NULL,
  CONSTRAINT promotionDemotion_member_id_fk FOREIGN KEY (member_id) REFERENCES public.member (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT promotionDemotion_admin_id_fk FOREIGN KEY (admin_id) REFERENCES public.member (id) ON DELETE CASCADE ON UPDATE CASCADE
);

/*TRIGGERS*/

CREATE FUNCTION check_admin_privileges_f()
  RETURNS TRIGGER AS $$
BEGIN
  IF ((
        SELECT privilege_level
        FROM member
        WHERE member.id = NEW.admin_id
      ) <> 'Administrator' :: PRIVILEGELEVEL)
  THEN
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

CREATE FUNCTION update_comment_mod_date_f()
  RETURNS TRIGGER AS $BODY$
BEGIN
  NEW.last_modification_date = current_timestamp;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER update_mod_date_tr
AFTER UPDATE
  ON comment
FOR EACH ROW
EXECUTE PROCEDURE update_comment_mod_date_f();

--update answer_count

CREATE FUNCTION update_question_answer_count_f()
  RETURNS TRIGGER AS $BODY$
BEGIN
  IF (TG_OP = 'INSERT')
  THEN

    UPDATE question AS q
    SET answer_count = q.answer_count + 1
    WHERE q.post_id = NEW.question_id;
    RETURN NEW;

  ELSE
    UPDATE question AS q
    SET answer_count = q.answer_count - 1
    WHERE q.post_id = old.question_id;
    RETURN old;

  END IF;
END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER update_question_answer_count_tr
BEFORE INSERT OR DELETE
  ON answer
FOR EACH ROW
EXECUTE PROCEDURE update_question_answer_count_f();

-- Update the promoted member's privilege_level

CREATE FUNCTION update_member_privilege_f()
  RETURNS TRIGGER AS $BODY$
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

-- Only 1 correct answer exists per question

CREATE FUNCTION one_correct_answer_per_question_f()
  RETURNS TRIGGER AS $$
BEGIN
  UPDATE answer
  SET correct = FALSE
  WHERE question_id = NEW.question_id -- all belong to same question
        AND answer.post_id <> NEW.post_id
        AND answer.correct = TRUE;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER one_correct_answer_per_question_tr
BEFORE UPDATE OF correct
  ON answer
FOR EACH ROW
WHEN (NEW.correct = TRUE AND OLD.correct = FALSE)
EXECUTE PROCEDURE one_correct_answer_per_question_f();

-- Deleting a vote decresases downvotes/upvotes

CREATE FUNCTION update_post_votes_f()
  RETURNS TRIGGER AS $$
BEGIN
  IF (TG_OP = 'DELETE')
  THEN
    IF (OLD.value) -- upvote
    THEN
      UPDATE post
      SET up_votes = up_votes - 1
      WHERE id = old.post_id;
    ELSE
      UPDATE post
      SET down_votes = down_votes - 1
      WHERE id = old.post_id;
    END IF;
  END IF;

  RETURN OLD;

END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER update_post_votes_tr
AFTER DELETE
  ON vote
FOR EACH ROW
EXECUTE PROCEDURE update_post_votes_f();


/** OTHER INDEXES **/

CREATE INDEX version_text_idx ON public.version USING GIN (to_tsvector('english', text));
CREATE INDEX question_title_idx ON public.question USING GIN (to_tsvector('english', title));

CREATE INDEX question_id_idx ON public.answer USING hash(question_id);
CREATE INDEX post_id_idx ON public.version USING hash(post_id);
CREATE INDEX post_id2_idx ON public.comment USING hash(post_id);
CREATE INDEX author_id_idx ON public.post USING hash(author_id);
CREATE INDEX category_id_idx ON public.question USING hash(category_id);