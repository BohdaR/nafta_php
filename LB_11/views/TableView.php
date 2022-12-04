<?php class TableView{
    public function print($menu,$table_body){
        $table_page='<html>
        <head>
            <title>View Data</title>
        </head>
        <body>
            <h1>View data</h1>
            '.$menu.'
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Operation</th>
                        <th>Input</th>
                        <th>Output</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    '.$table_body.'
                </tbody>
            </table>
        </body>
    </html>';
    return $table_page;
    }
}