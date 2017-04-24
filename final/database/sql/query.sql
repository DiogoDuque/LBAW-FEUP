-- Finding the questions in a category
CREATE OR REPLACE FUNCTION find_questions_of_category_f(categoryId INTEGER)
    RETURNS TABLE(username VARCHAR(20), title TEXT, view_count INTEGER, text TEXT,
                  answer_count INTEGER, up_votes INTEGER, down_votes INTEGER) AS $$
  SELECT member.username, question.title, question.view_count,
    version1.text, question.answer_count, post.up_votes, post.down_votes
  FROM public.version AS version1
  JOIN public.post ON post.id = version1.post_id
  JOIN public.question ON public.question.post_id = public.post.id
  JOIN public.category ON public.question.category_id = public.category.id
  JOIN public.member ON post.author_id = member.id
  WHERE public.category.id = categoryId AND version1.date=(SELECT max(version2.date) FROM version as version2 WHERE version1.id=version2.id);
$$ LANGUAGE SQL;

-- Usage
SELECT find_questions_of_category_f(1) AS Questions;


-- Finding the answers to a question
CREATE OR REPLACE FUNCTION find_answers_of_a_question_f(questionId INTEGER)
    RETURNS TABLE(username VARCHAR(20), text TEXT,
      up_votes INTEGER, down_votes INTEGER, correct BOOL) AS $$
  SELECT member.username, version1.text, post.up_votes, post.down_votes, answer.correct
    FROM public.version AS version1
    JOIN public.post ON version1.post_id = post.id
    JOIN public.answer ON post.id = answer.post_id
    JOIN public.question ON public.question.post_id = public.answer.question_id
    JOIN public.member ON post.author_id = member.id
    WHERE public.answer.question_id = questionId
          AND version1.date=(SELECT max(version2.date) FROM version as version2 WHERE version1.id=version2.id);
$$ LANGUAGE SQL;

-- Usage
SELECT find_answers_of_a_question_f(1) AS Answers;


-- Finding versions of a post
CREATE OR REPLACE FUNCTION find_versions_of_a_post_f(postId INTEGER)
    RETURNS TABLE(text TEXT, date TIMESTAMP) AS $$
  SELECT version.text, version.date
  FROM version
  WHERE public.version.post_id = postId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_versions_of_a_post_f(10) AS Versions;


-- Finding comments to a post
CREATE OR REPLACE FUNCTION find_comments_of_a_post_f(postId INTEGER)
    RETURNS TABLE(username VARCHAR(20), text TEXT, last_mod_date TIMESTAMP) AS $$
  SELECT member.username, comment.text, comment.last_modification_date
  FROM public.comment
  JOIN public.member ON public.member.id = public.comment.member_id
  WHERE public.comment.post_id = postId;
$$ LANGUAGE SQL;

-- Usage
SELECT find_comments_of_a_post_f(10) AS Comments;


-- Searching for a member's posts
CREATE OR REPLACE FUNCTION find_posts_of_member_f(memberId INTEGER)
    RETURNS TABLE(text TEXT, up_votes INTEGER, down_votes INTEGER) AS $$
  SELECT version1.text, post.up_votes, post.down_votes
  FROM public.version AS version1
  JOIN public.post ON version1.post_id = post.id
  WHERE post.author_id = memberId
        AND version1.date=(SELECT max(version2.date) FROM version as version2 WHERE version1.id=version2.id);
$$ LANGUAGE SQL;

-- Usage
SELECT find_posts_of_member_f(3) AS Posts;
