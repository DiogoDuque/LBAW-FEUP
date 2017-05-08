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

/** OTHER INDEXES **/

CREATE INDEX version_text_idx ON public.version USING GIN (to_tsvector('english', text));
CREATE INDEX question_title_idx ON public.question USING GIN (to_tsvector('english', title));

CREATE INDEX question_id_idx ON public.answer USING hash(question_id);
CREATE INDEX post_id_idx ON public.version USING hash(post_id);
CREATE INDEX post_id2_idx ON public.comment USING hash(post_id);
CREATE INDEX author_id_idx ON public.post USING hash(author_id);
CREATE INDEX category_id_idx ON public.question USING hash(category_id);