<?php
class HeaderView{
    public function print(){
        $header_menu='<p>
        <a href="index.php?action=view_all">View Data</a>
        <a href="index.php?action=add_new_op">Add Operation</a>
        <a href="index.php?action=sendmail">Send Feedback</a>
        <a href="index.php?action=getjson">JSON Endpoint</a>
        <a href="index.php?action=logout">Logout</a>
        </p>';
        return $header_menu;
    }
}

?>
