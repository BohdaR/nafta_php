<?php class FeedbackView{
    public function print($menu){
        $feedback_page='<html>
        <head>
            <title>Send Feedback</title>
        </head>
        <body>
            <h1>Send Feedback</h1>
            '.$menu.'
            <form method="POST" action="">
                <input type="email" placeholder="email" name="email" required/></br>
                <input type="text" placeholder="subject" name="subject" required/></br>
                <textarea placeholder="message" name="message"></textarea></br>
                <input type="submit" value="Send"/>
            </form>
        </body>
    </html>';
    return $feedback_page;
    }
}