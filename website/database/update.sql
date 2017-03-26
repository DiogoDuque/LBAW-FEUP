CREATE OR REPLACE FUNCTION update_member_email_f(email VARCHAR(254), memberId INTEGER) RETURNS VOID AS $$

  UPDATE Member
  SET public.member.email = email
  WHERE public.member.id=memberId

$$ LANGUAGE SQL;

