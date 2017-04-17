DROP FUNCTION IF EXISTS update_member_email_f(character varying, INTEGER);
DROP FUNCTION IF EXISTS update_member_profile_image_f(INTEGER, INTEGER);


-- Update member's email
CREATE OR REPLACE FUNCTION update_member_email_f(memberId INTEGER, newEmail VARCHAR(254)) RETURNS BOOLEAN AS $$

BEGIN
  UPDATE public.member
  SET email = newEmail
  WHERE public.member.id=memberId;

  RETURN FOUND;
END;

$$ LANGUAGE PLPGSQL;

-- Usage
SELECT update_member_email_f(1, 'a@a.com') AS Completed;

-- Update member's profile image
CREATE OR REPLACE FUNCTION update_member_profile_image_f(memberId INTEGER, newImageId INTEGER) RETURNS INTEGER AS $$
DECLARE
  newId INTEGER;

BEGIN

  newId = -1;

  -- Check that new Id exists
  newId = (SELECT public.image.id FROM public.image WHERE image.id=newImageId);

  IF(newId = -1) THEN
    RETURN -1;
  END IF;

  -- Update
  UPDATE public.member
  SET image_id = newId
  WHERE public.member.id=memberId;

  IF(FOUND) THEN
    RETURN 0;
  ELSE
    RETURN -2;

END IF;

END;

$$ LANGUAGE PLPGSQL;

-- Usage
SELECT update_member_profile_image_f(1, 1) AS Changed;


-- Update the votes count on posts where it is needed
CREATE OR REPLACE FUNCTION count_votes_f(id integer, last_update DATE, value BOOL) RETURNS INTEGER AS $$
DECLARE
  result INTEGER;
BEGIN
  SELECT COUNT(*) INTO result FROM vote
    WHERE vote.post_id=$1 AND vote.creation_date>$2 AND vote.value=$3;
  RETURN result;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_votes_in_posts_f (last_update DATE) RETURNS VOID AS $$
BEGIN
  UPDATE post
    SET up_votes=up_votes+(count_votes_f(post.id,$1,TRUE)),
      down_votes=down_votes+(count_votes_f(post.id,$1,FALSE));
END;
$$ LANGUAGE plpgsql;

-- Usage
SELECT update_votes_in_posts_f('1999-01-08');


-- Update user reputation base on votes on his posts
CREATE FUNCTION get_added_reputation(member_id INTEGER, last_update DATE, value BOOL) RETURNS INTEGER AS $$
DECLARE
  reputation INTEGER;
BEGIN
  SELECT COUNT(*) INTO reputation FROM vote
    WHERE vote.member_id=$1 AND vote.creation_date>$2 AND vote.value=$3;
  RETURN reputation;
END;
$$ LANGUAGE plpgsql;

CREATE FUNCTION update_reputation_f(last_update DATE) RETURNS VOID AS $$
BEGIN
  UPDATE member
    SET reputation=member.reputation+get_added_reputation(id, last_update, TRUE)-get_added_reputation(id, last_update, FALSE);
END;
$$ LANGUAGE plpgsql;

-- Usage
SELECT update_reputation_f('1999-01-08');