-- Searching for the ids of a member's posts
CREATE FUNCTION find_posts_of_member_f(memberId integer) RETURNS integer AS $$
  SELECT public.post.id
  FROM public.post JOIN public.member ON post.author_id = member.id
  WHERE author_id = memberId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_posts_of_member_f(48) AS Posts;