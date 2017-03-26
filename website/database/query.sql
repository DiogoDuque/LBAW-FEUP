-- Finding the questions in a category
CREATE OR REPLACE FUNCTION find_questions_of_category_f(categoryId integer) RETURNS SETOF integer AS $$
  SELECT public.question.post_id
  FROM public.question JOIN public.category ON public.question.category_id = public.category.id
  WHERE public.category.id = categoryId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_questions_of_category_f(1) AS Questions;

-- Finding the answers to a question
CREATE OR REPLACE FUNCTION find_answers_of_a_question_f(questionId integer) RETURNS SETOF integer AS $$
  SELECT public.answer.post_id
  FROM public.answer JOIN public.question ON public.question.post_id = public.answer.question_id
  WHERE public.answer.question_id = questionId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_answers_of_a_question_f(1) AS Answers;

-- Finding versions of a post
CREATE OR REPLACE FUNCTION find_versions_of_a_post_f(postId integer) RETURNS SETOF integer AS $$
  SELECT public.version.id
  FROM public.post JOIN public.version ON public.post.id = public.version.post_id
  WHERE public.version.post_id = postId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_versions_of_a_post_f(10) AS Versions;

-- Finding comments to a post
CREATE OR REPLACE FUNCTION find_comments_of_a_post_f(postId integer) RETURNS SETOF integer AS $$
  SELECT public.comment.id
  FROM public.post JOIN public.comment ON public.post.id = public.comment.post_id
  WHERE public.comment.post_id = postId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_comments_of_a_post_f(10) AS Comments;

-- Searching for the ids of a member's posts
CREATE OR REPLACE FUNCTION find_posts_of_member_f(memberId integer) RETURNS SETOF integer AS $$
  SELECT public.post.id
  FROM public.post JOIN public.member ON post.author_id = member.id
  WHERE author_id = memberId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_posts_of_member_f(48) AS Posts;