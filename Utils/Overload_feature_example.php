/*******************************
 * author  : hishamdalal@gmail.com 
 * version : 3.1
 * date    : 2013-04-11
 *****************************/

<?php

    class overloadable
    {
        protected $fname = null;
        protected $fargs = array();

        //--------------------------------------------------//
        function set($obj, $fname, $args){
            $n = ''; 
            $type = $this->getType($args); 
            $n  = "\$o = new $obj();\n";
            $n .= "if(method_exists(\$o, '$fname"."_$type')){\n";
            $n .= "\t\$r = \$o->$fname"."_$type(". $this->getArgsName($args) .");\n";
            $n .= "}else{\n\t\$r = null;\n";
            $n .= "\ttrigger_error('function ".$fname."_".$type." is not exist!');\n}";
            eval("\$r = $n;");
            return $r;
        }
        //--------------------------------------------------//
        function getType($args) {
            $argType = array();
            foreach($args as $i=>$val) {
                $argType[$i][] = $this->getSuffix($val, $i) ;
            }
            $s = '';
            if(is_array($argType)){
                foreach($argType as $type){
                    $s  .= implode('', $type);
                }
                return $s;
            }
            return implode('', $argType);
        }
        //--------------------------------------------------//
        function getSuffix($byValarg, $i) {
                if( is_numeric($byValarg) ) {
                    $type = 'N'; 
                    $this->fargs['N'.$i] = $byValarg;
                } elseif( is_array($byValarg) ) {
                    $type = 'A';
                    $this->fargs['A'.$i] = $byValarg;
                } elseif( is_object($byValarg) ) {
                    $type = 'O'; 
                    $this->fargs['O'.$i] = $byValarg;
                } elseif( is_resource($byValarg) ) {
                    $type = 'R'; 
                    $this->fargs['R'.$i] = $byValarg;
                } else {
                    $type = 'S'; 
                    $this->fargs['S'.$i] = $byValarg;
                }   
                return $type;
        }
        //--------------------------------------------------//
        function getArgsName($args){
            $r = array();
            $ary = array_keys($this->fargs);
            foreach( $ary as $k=>$v){
                $r[]='$this->fargs["'.$v.'"]';
            }
            return implode(", ", $r);
        }
        //--------------------------------------------------//  
        function __call($name, $args){
            $this->fargs = array();
            return $this->set(get_class($this), $name, $args);
        }
        //--------------------------------------------------//  
    }


    class test2 extends overloadable {
        function foo_(){
            echo 'foo - no args';
        }
        function foo_S($s){
            echo "foo - one string $s";
        }
        function foo_SS($s1, $s2){
            echo "foo - tow strings $s1, $s2";
        }   
        function foo_SN($s, $n){
            echo "foo - string and number $s, $n";
        }
        function foo_A($ary){
            print_r($ary);
        }
        function foo_AA($ary1, $ary2){
            if(is_array($ary1) && is_array($ary2)){
                echo "foo - tow arrays";
            }else{echo 0;}
        }   
        function foo_O($obj){
            echo "foo - ";
            print_r($obj);
        }
        function hi(){
            echo "hi - welcome!";
        }
    }

    echo '<pre>';
    $t = new test2();

    echo '<br />foo_: ';
    print_r( $t->foo() );

    echo '<br />foo_s: ';
    print_r( $t->foo('a') );

    echo '<br />foo_ss: ';
    print_r( $t->foo('a', 'b') );

    echo '<br />foo_sn: ';
    print_r( $t->foo('a', 2) );

    echo '<br />foo_snn: ';
    print_r( $t->foo('s', 2, 9) );

    echo '<br />foo_a: ';
    print_r( $t->foo(array(4,5,6,7)) );

    echo '<br />foo_aa: ';
    print_r( $t->foo( array(5,6,7), array(8,9,10) ) );

    echo '<br />foo_o: ';
    print_r( $t->foo($t) );

    echo '<br />hi: ';
    print_r( $t->hi() );
?>