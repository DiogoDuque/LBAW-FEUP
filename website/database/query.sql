-- Finding the questions in a category
CREATE OR REPLACE FUNCTION find_questions_of_category_f(categoryId INTEGER) RETURNS SETOF INTEGER AS $$
  SELECT public.question.post_id
  FROM public.question JOIN public.category ON public.question.category_id = public.category.id
  WHERE public.category.id = categoryId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_questions_of_category_f(1) AS Questions;

-- Finding the answers to a question
CREATE OR REPLACE FUNCTION find_answers_of_a_question_f(questionId INTEGER) RETURNS SETOF INTEGER AS $$
  SELECT public.answer.post_id
  FROM public.answer JOIN public.question ON public.question.post_id = public.answer.question_id
  WHERE public.answer.question_id = questionId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_answers_of_a_question_f(1) AS Answers;

-- Finding versions of a post
CREATE OR REPLACE FUNCTION find_versions_of_a_post_f(postId INTEGER) RETURNS SETOF INTEGER AS $$
  SELECT public.version.id
  FROM public.post JOIN public.version ON public.post.id = public.version.post_id
  WHERE public.version.post_id = postId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_versions_of_a_post_f(10) AS Versions;

-- Finding comments to a post
CREATE OR REPLACE FUNCTION find_comments_of_a_post_f(postId INTEGER) RETURNS SETOF INTEGER AS $$
  SELECT public.comment.id
  FROM public.post JOIN public.comment ON public.post.id = public.comment.post_id
  WHERE public.comment.post_id = postId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_comments_of_a_post_f(10) AS Comments;

-- Searching for the ids of a member's posts
CREATE OR REPLACE FUNCTION find_posts_of_member_f(memberId INTEGER) RETURNS SETOF INTEGER AS $$
  SELECT public.post.id
  FROM public.post JOIN public.member ON post.author_id = member.id
  WHERE author_id = memberId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_posts_of_member_f(48) AS Posts;

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