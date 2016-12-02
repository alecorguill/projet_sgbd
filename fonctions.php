function connectBase(){
    $base = mysql_connect ('localhost', 'lchaumartin', 'vivi86ga');  
    mysql_select_db ('lchaumartin', $base) ;
}

