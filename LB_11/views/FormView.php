<?php
class FormView{
    public function print($menu,$operation_options){
        $form_view='<html>
        <head>
            <title>Add New Operation</title>
        </head>
        <body>
        '.$menu.'
            <form method="POST" action="index.php">
                <p>
                    <label for="optype">Select operation type:</label>
                </p>
                <p>
                    <select name="optype">
                        '.$operation_options.'
                    </select>
                </p>
                <p>
                    <label for="opdata">Enter array with elements separated by space:</label>
                </p>
                <p>
                    <input type="text" name="opdata" required>
                </p>
                <p>
                    <input type="submit" value="Send data">
                </p>
            </form>
        </body>
    </html>';
    return $form_view;
    }
}
