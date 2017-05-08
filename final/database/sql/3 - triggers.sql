/*TRIGGERS*/

DROP FUNCTION IF EXISTS check_admin_privileges_f() CASCADE ;

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