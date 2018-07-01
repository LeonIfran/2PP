<?php 
class MWparaFiltrar
{
    public function FiltrarDatos($request, $response, $next)
    {
        $response = $next($request, $response);
        $body = $response->getBody()->__toString();
        $response = $response->withJson($body,200); // output should be {"data":" Hello, User  seq1  seq2 "}
        return $response;
    }
}


?>