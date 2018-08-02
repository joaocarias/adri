<?php

include_once '../lib/View.php';
require_once("../lib/MPDF57/mpdf.php");
include_once '../lib/Sistema.php';
include_once '../lib/Auxiliar.php';
include_once '../app/model/Inscricao.php';
include_once '../app/model/Cargo.php';
include_once '../app/model/Funcao.php';
include_once '../app/model/Unidade.php';
include_once '../app/model/Avaliacao.php';


/**
 * Description of InscricaoPrintView
 *
 * @author joao.franca
 */
class RelClassificaPrintView extends View {
    public function get($action = null, $params = null){
        
       $action = filter_input(INPUT_POST, 'tx_opcao', FILTER_SANITIZE_STRING);
        $unidade = filter_input(INPUT_POST, 'tx_unidade', FILTER_SANITIZE_STRING);
       $cargo = filter_input(INPUT_POST, 'tx_cargo', FILTER_SANITIZE_STRING);
       $funcao = filter_input(INPUT_POST, 'tx_funcao', FILTER_SANITIZE_STRING);
       
        $subtitle = "";
       
       if($action == 1){
            $opcao = 'unidade_desejo1';
            $subtitle = "1° Unidade de Desejo";
        }else if($action == 2){
            $opcao = 'unidade_desejo2';
            $subtitle = "2° Unidade de Desejo";
        }else if($action == 3){
            $opcao = 'unidade_desejo3';
            $subtitle = "3° Unidade de Desejo";
        }
//       die("Sub: $subtitle, Op: $opcao, Uni: $unidade, carg: $cargo, fun: $funcao");
       $this->getMpdf($subtitle, $opcao, $unidade, $cargo, $funcao);              
       
    }
    
    
    
    private function getHtml($subtitle, $opcao, $unidade, $cargo, $funcao){
        $meu_html = "";
        
        $arrayFiltro = array();
        if($unidade || $cargo || $funcao ){
            if($unidade){
                $arrayFiltro[$opcao] = $unidade;
            }

            if($cargo){
                $arrayFiltro['cargo'] = $cargo;
            }

            if($funcao){
                $arrayFiltro['funcao'] = $funcao;
            }            
        }else{
            $arrayFiltro = null;
        }
            
            
        if(!is_null($arrayFiltro)){

            $objUnidade = new Unidade();
            $objCargo = new Cargo();
            $objFuncao = new Funcao();
                        
            $subtitle .= isset($arrayFiltro[$opcao]) ? " - " .  $objUnidade->selectObj($unidade)->getNome_unidade() : "";
            $subtitle .= isset($arrayFiltro['cargo']) ? " - " .  $objCargo->selectObj($cargo)->getNome_cargo() : "";
            $subtitle .= isset($arrayFiltro['funcao']) ? " - " .  $objFuncao->selectObj($funcao)->getNome_funcao() : "";
//            die($subtitle);
            $objAvaliacao = new Avaliacao();
            $dados = $objAvaliacao->getDadosClassificacao($arrayFiltro);
            
            foreach ($dados as $row2){
                $objInscricao1 = new Inscricao();
                $servidor1 = $objInscricao1->selectObj($row2->id_inscricao);
                
                $tempoAdmissao = $objAvaliacao->tempoDeServico($servidor1->getDataChegadaSms());
                $tempoUnidade = $objAvaliacao->tempoDeServico($servidor1->getDataChegadaAtual());
                $tempoSetor = $objAvaliacao->tempoDeServico($servidor1->getDataChegadaSetor());
                
                $row2->pontuacao += $objAvaliacao->pontuacaoTempo($tempoAdmissao, 1);
                $row2->pontuacao += $objAvaliacao->pontuacaoTempo($tempoUnidade, 2);
                $row2->pontuacao += $objAvaliacao->pontuacaoTempo($tempoSetor, 3);
            }
            
            usort($dados,
                 function( $a, $b ) {
                     if( $a->pontuacao == $b->pontuacao ) return 0;
                     return ( ( $a->pontuacao > $b->pontuacao ) ? -1 : 1 );
                 }
            );
            
            $linhas = "";
            $posicao = 1;
            
            foreach ($dados as $row){
                        
        
            $objInscricao = new Inscricao();
            $servidor = $objInscricao->selectObj($row->id_inscricao);

//            $button_mais_informacoes = "<a id='btn_mais_informacoes' name='btn-mais-informacoes' href='servidor.php?idinscricao={$row->id_inscricao}' class='btn btn-info btn-sm'>Mais Informações</a>";

            $status = "";
            $class = "";
            if ($servidor->getUnidadeAtual() == 89 || $servidor->getUnidadeAtual() == 157){
                $status = "#32CD32";
                $class = "gold";
            }
            elseif($row->pergunta8 == 3){
                $status = "red";
                $class = "red";
            }
            if ($servidor->getCargo() == 110){
                $status = "blue";
                $class = "blue";
            }
            
                $linhas .= '<tr class="'.$class.'" style="'.$status.'">
                                  <th scope="row"><font color="'.$status.'">'.$posicao.'</font></th>
                                  <td><font color="'.$status.'">'.$servidor->getNomeServidor().'</font></td>
                                  <td><font color="'.$status.'">'.$servidor->getCpfServidor().'</font></td>
                                  <td><font color="'.$status.'">'.$objUnidade->selectObj($servidor->getUnidadeAtual())->getNome_unidade().'</font></td>                              
                                  <td><font color="'.$status.'">'.$objCargo->selectObj($servidor->getCargo())->getNome_cargo().'</font></td>                              
                                  <td><font color="'.$status.'">'.$objFuncao->selectObj($servidor->getFuncao())->getNome_funcao().'</font></td>        
                                  <td><font color="'.$status.'">'.
                                            $row->pontuacao
                                       .'</font></td>   
                                   <td><font color="'.$status.'">'.Auxiliar::converterDataParaBR($servidor->getDataChegadaSms()).'</font></td>
                            </tr>
                            ';
                
                $posicao++;
            }

            $meu_html .= '<!DOCTYPE html>
                    <html>'.
            $this->getHeader()
                     . '<body style=" font-size: 10pt;">
                         <style>
                            table.bordasimples {border-collapse: collapse;}
                            table.bordasimples tr td {border:1px solid; text-align: center;}
                            table.bordasimples tr th {border:1px solid;}
                          </style>
                      <p><address><strong>PREFEITURA MUNICIPAL DO NATAL</strong><br/>                            
                                <strong>Secretaria Municipal de Saúde - SMS</strong><br />
                                R. Fabrício Pedroza, 915 <br />
                                CEP: 59014-030 - Area Preta, Natal - RN <br />                                
                            </address>
                       </p>
                     <hr />
                        <div class="col-lg-12">                  
                          <h3 class="h4">Relatório Classificação '.$subtitle.'</h3>
                              <p><strong>Legenda:</strong> <font color="red">Avaliador não Autoriza Saída do Servidor</font>/ <font color="blue">Cargo de Nível Superior</font>/ <font color="#32CD32">Disponível ao Nível Central</font></p>
                          <div class="table-responsive">                       
                            <table class="table bordasimples">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>SERVIDOR</th>                              
                                  <th>CPF</th>                              
                                  <th>UNIDADE ATUAL</th>                              
                                  <th>CARGO</th>                              
                                  <th>FUNÇÃO</th>        
                                  <th>PONTUAÇÃO</th>      
                                  <th>DATA ADMISSÃO</th>
                                </tr>
                              </thead>
                              <tbody>
                                   '.$linhas.'            
                              </tbody>
                            </table>
                          </div>
                          '.$this->getListaNaoAvaliados($opcao, $unidade, $cargo, $funcao).'
                   </div>
                  </body>
                    </html>';
        }
                      
//        }
//            echo $meu_html;
        return $meu_html;
    }
    
    private function getListaNaoAvaliados($opcao, $unidade, $cargo, $funcao){
        $content_ = '';    

        $arrayFiltro = array();
        if($unidade || $cargo || $funcao ){
            if($unidade){
                $arrayFiltro[$opcao] = $unidade;
            }

            if($cargo){
                $arrayFiltro['cargo'] = $cargo;
            }

            if($funcao){
                $arrayFiltro['funcao'] = $funcao;
            }            
        }else{
            $arrayFiltro = null;
        }

        if(!is_null($arrayFiltro)){

            $objUnidade = new Unidade();
            $objCargo = new Cargo();
            $objFuncao = new Funcao();
            
            $linhas = "";
            $posicao = 1;

            $objInscricao = new Inscricao();
            $arrayInscricoes = $objInscricao->getListNaoAvaliados($arrayFiltro);
            
            foreach ($arrayInscricoes as $row){
                
            
                $status = "";
            if ($row->getUnidadeAtual() == 89 || $row->getUnidadeAtual() == 157){
                $status = "#32CD32";
            }
            elseif ($row->getCargo() == 110){
                    $status = "blue";
            }

            //$button_mais_informacoes = "<a id='btn_mais_informacoes' name='btn-mais-informacoes' href='servidor.php?idinscricao={$row->getIdInscricao()}' class='btn btn-info btn-sm'>Mais Informações</a>";

                $linhas .= '<tr>
                                  <th scope="row"><font color="'.$status.'">'.$posicao.'</font></th>
                                  <td><font color="'.$status.'">'.$row->getNomeServidor().'</font></td>
                                  <td><font color="'.$status.'">'.$row->getCpfServidor().'</font></td>
                                  <td><font color="'.$status.'">'.$objUnidade->selectObj($row->getUnidadeAtual())->getNome_unidade().'</font></td>                              
                                  <td><font color="'.$status.'">'.$objCargo->selectObj($row->getCargo())->getNome_cargo().'</font></td>                              
                                  <td><font color="'.$status.'">'.$objFuncao->selectObj($row->getFuncao())->getNome_funcao().'</font></td>        
                                  
                                   <td><font color="'.$status.'">'.Auxiliar::converterDataParaBR($row->getDataChegadaSms()).'</font></td>
                            </tr>
                            ';
                
                $posicao++;
            }           

            $content_ .= ' <hr>
                <div class="col-lg-12">
                          <h3 class="h4">Não Avaliados</h3>
                   </div>
                   <div class="table-responsive">                       
                            <table class="table bordasimples">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>SERVIDOR</th>                              
                                  <th>CPF</th>                              
                                  <th>UNIDADE ATUAL</th>                              
                                  <th>CARGO</th>                              
                                  <th>FUNÇÃO</th>         
                                  
                                  <th>DATA ADMISSÃO</th>
                                </tr>
                              </thead>
                              <tbody>
                                   '.$linhas.'            
                              </tbody>
                            </table>
                          </div>';
            
        }
                                  
        return $content_;       
    }
    
    private function getMpdf($subtitle, $opcao = null, $unidade = null, $cargo = null, $funcao = null){
                
        $html = $this->getHtml($subtitle, $opcao, $unidade, $cargo, $funcao);
        $sistema = new Sistema();
        $mpdf=new mPDF('c','A4');
            $mpdf->SetHeader("{$sistema->getCompany()} || {$sistema->getName()}  ");
           //  $mpdf->SetHeader("{$sistema->getCompany()} || {$sistema->getName()}  ");
            $mpdf->AddPage('L');
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->setFooter("Relatório Classificação $subtitle | Gerado em: ".  date("d/m/Y H:i:s") ." | Página: {PAGENO}") ;

            $mpdf->WriteHTML($html);

            $mpdf->Output("relClassificacao.pdf","I");
    }
    
    
}
