<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ct extends Model
{
    use HasFactory;

    protected $ct_path;

    protected $m_dec_data;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->ct_path = config("app.env") == "local" ? "/bin/ct_cli_exe" : "/bin/ct_cli";
    }

    function mf_clear()
    {
        $this->m_dec_data="";
    }

    function make_hash_data( $home_dir , $key , $str )
    {
        $hash_data = $this -> mf_exec( $home_dir . $this->ct_path ,
            "lf_CT_CLI__make_hash_data",
            $key,
            $str
        );

        if ( $hash_data == "" ) { $hash_data = "HS01"; }

        return $hash_data;
    }

    function check_valid_hash ($home_dir , $key , $hash_data , $str )
    {
        $ret_val = $this -> mf_exec( $home_dir . $this->ct_path ,
            "lf_CT_CLI__check_valid_hash" ,
            $key,
            $hash_data ,
            $str
        );

        if ( $ret_val == "" ) { $ret_val = "HS02"; }

        return $ret_val;
    }

    function decrypt_enc_cert ( $home_dir, $key , $site_cd , $cert_no , $enc_cert_data )
    {
        $dec_data = $this -> mf_exec( $home_dir . $this->ct_path,
            "lf_CT_CLI__decrypt_enc_cert" ,
            $key,
            $site_cd ,
            $cert_no ,
            $enc_cert_data
        );
        if ( $dec_data == "" ) { $dec_data = "HS03"; }


        parse_str( str_replace( chr( 31 ), "&", $dec_data ), $this->m_dec_data );

        return $dec_data;
    }

    function get_kcp_lib_ver( $home_dir )
    {
        $ver_data = $this -> mf_exec( $home_dir . $this->ct_path ,
            "lf_CT_CLI__get_kcp_lib_ver"
        );

        if ( $ver_data == "" ) { $hash_data = "HS04"; }

        return $ver_data;
    }

    function mf_get_key_value( $name )
    {
        return isset($this->m_dec_data[$name]) ? $this->m_dec_data[ $name ] : "";
    }

    function  mf_exec()
    {
        $arg = func_get_args();

        if ( is_array( $arg[0] ) )  $arg = $arg[0];

        $exec_cmd = array_shift( $arg );

        foreach($arg as $i)
        {
            $exec_cmd .= " " . escapeshellarg( $i );
        }

        $rt = exec( $exec_cmd );

        return  $rt;
    }
}


