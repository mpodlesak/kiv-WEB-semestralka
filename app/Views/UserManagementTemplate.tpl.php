<?php

    global $tplData;

    // pripojim objekt pro vypis hlavicky a paticky HTML
    require(DIRECTORY_VIEWS ."/TemplateBasics.class.php");
    $tplHeaders = new TemplateBasics();


    $tplHeaders->getHTMLHeader($tplData['title']);



    $res = '<article class="container">
                                <div class="jumbotron">
                                    <div class="col-12 text-justify">
                                        <div class="table-responsive">';

                                        if(isset($tplData['alert'])){
                                            $res .= "<div class='alert'>" . $tplData['delete']. "</div>";
                                        }

                                        $res .= '<table class="table table-sm table-bordered table-striped table-hover text-left">
                                                    <thead class="thead-dark text-center">
                                                    <tr><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Login</th><th>E-mail</th><th>Potvrzený</th><th>Vymazat</th></tr>';

                                        foreach($tplData['users'] as $u){
                                            if ($this->db->isVerified($u['id_uzivatel'])){
                                                $verifydBtn = '<i class="fa fa-check text-success"></i>';
                                            }
                                            else{
                                                $verifydBtn = "<button type='submit' name='action' value='verify' class='btn btn-outline-dark btn-sm'>Potvrdit</button>";
                                            }

                                            $res .= "<tr><td>$u[id_uzivatel]</td><td>$u[jmeno]</td><td>$u[prijmeni]</td><td>$u[login]</td><td>$u[email]</td>"
                                                    .'<td> <form method="post">' .$verifydBtn. ' </td>'
                                                    ."<td>"
                                                    ."<input type='hidden' name='id_user' value='$u[id_uzivatel]'>"
                                                    ."<button type='submit' name='action' value='delete' style='border: none; background: none'> <i class='fa fa-trash text-danger'></i> </button>"
                                                    ."</form></td></tr>";
                                        }

                                        $res .= "</table>";

    $res .=                             '</div>
                                    </div>
                                </div>
                            </article>
                        </div>';

    echo $res;

    // paticka
    $tplHeaders->getHTMLFooterShort();

?>
