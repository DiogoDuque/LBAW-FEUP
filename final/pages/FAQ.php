<?php

include_once("../config/init.php");

$smarty->display("common/header.tpl"); ?>

<div class="container">
    <h1>Frequently asked questions (FAQ)</h1>

    <h2>HoWhy</h2>

    <h4>What is the purpose of this website?</h4>
    <p>This website was designed to help people help people.
        Basically, we let a person who has a bit more knowledge in some area help you with your problems.</p>

    <br>

    <h4>How can I participate?</h4>
    <p>Only registered members may ask or answer questions. To register in HoWhy you only need to provide an username,
        your email and choose a password.
        You pay nothing and we don't have any ads! Click that shiny 'Sign Up' button on the top bar and get started!</p>

    <br>

    <h4>I cannot access my account. Why?</h4>
    <p>There are several reasons for this occurrence. You may be using a wrong password, you may have been banned, etc. To find out what happened, pay attention to the error message shown after your attempt.</p>

    <br>

    <h4>What are the main rules?</h4>
    <p>In this website, we promote well-being and sympathy. For that, we have a few guidelines for a well behaviour:</p>

    <ul>
        <li>Do not <b>insult</b> other users. Don't be racist, homophobic or discriminate other people in general.</li>
        <li>Do not use <b>slur or bad words</b> in your posts.</li>
        <li>Do not <b>advertise</b> anything on your posts.</li>
    </ul>

    <p>The staff still holds the right to judge a situation in particular and act as we see fit.</p>

    <br>

    <h4>I think my password was stolen! What can I do?</h4>
    <p>First: don’t panic. Second: send us an email to <a href="mailto:general@howhy.com">general@howhy.com</a>, and let’s solve it together :)</p>

    <br>

    <h4>I have a question that is not answered here...</h4>
    <p>Feel free to send us an email to <a href="mailto:general@howhy.com">general@howhy.com</a>, we will do our best to help you!</p>

    <br>

    <h2>Score system</h2>

    <h4>Can I vote on any question or answer?</h4>
    <p>Yes, except your own. This isn't Facebook. You can't like what you type.</p>

    <br>

    <h4>How can I rise my score?</h4>
    <p>To rise your score, you must ask good questions and provide good answers.
        Do not complicate, as this makes it harder for people to understand you and you won’t get so many upvotes
        that way. Last but not least, be a good person.</p>

    <h2>User classes</h2>
    <h4>What is the hierarchy on this website?</h4>
    <p> The user hierarchy here goes, from top to bottom, like this:</p>

    <ul>
        <li><b>Administrator</b>: has all the privileges, including making promotions/demotions and deleting accounts.</li>
        <li><b>Moderator</b>: may edit answers, questions and comments</li>
        <li><b>Member</b>: may post answer, questions or comments</li>
    </ul>

    <br>



</div>


<?php

$smarty->display("common/footer.tpl");

?>
