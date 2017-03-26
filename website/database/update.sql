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