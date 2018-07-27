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
class RelInscricaoPrintView extends View {
    public function get($action = null, $params = null){
        
       $unidade = filter_input(INPUT_POST, 'tx_unidade', FILTER_SANITIZE_STRING);
       $cargo = filter_input(INPUT_POST, 'tx_cargo', FILTER_SANITIZE_STRING);
       $funcao = filter_input(INPUT_POST, 'tx_funcao', FILTER_SANITIZE_STRING);
       
//       die("Uni: $unidade, carg: $cargo, fun: $funcao");
       $this->getMpdf($unidade, $cargo, $funcao);              
       
    }
    
    private function getHtml($unidade, $cargo, $funcao){
        $meu_html = "";
        
        $arrayFiltro = array();
            if($unidade || $cargo || $funcao ){
                if($unidade){
                    $arrayFiltro['unidade_atual'] = $unidade;
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
        
            $objInscricao = new Inscricao();
            $listaInscritos = $objInscricao->getListObjActive($arrayFiltro);
                        
            $objUnidade = new Unidade();
            $objCargo = new Cargo();
            $objFuncao = new Funcao();
            $objAvaliacao = new Avaliacao();
            
            $subtitle = "";
            
            $subtitle .= isset($arrayFiltro['unidade_atual']) ? " - " .  $objUnidade->selectObj($unidade)->getNome_unidade() : "";
            $subtitle .= isset($arrayFiltro['cargo']) ? " - " .  $objCargo->selectObj($cargo)->getNome_cargo() : "";
            $subtitle .= isset($arrayFiltro['funcao']) ? " - " .  $objFuncao->selectObj($funcao)->getNome_funcao() : "";

            $linhas = "";
            $qtdInscritos = 0;
            
            foreach ($listaInscritos as $item){
                $classe_nao_avaliado = "";
                $status = "";
                
                if($objAvaliacao->is_avaliado($item->getIdInscricao())){
                    $pontuacao = '<strong>'.$objAvaliacao->getPontuacao($item->getIdInscricao()).'</strong>';
                    
                    if($objAvaliacao->getObjPorInscricao($item->getIdInscricao())->getPergunta8() == 3){
                        $status = "red";
                    }
                }else{                    
                    $pontuacao = '<font color="red">Ainda não Avaliado</font>';
                }
                
                $servidor = $objInscricao->selectObj($item->getIdInscricao());
                if ($servidor->getUnidadeAtual() == 89 || $servidor->getUnidadeAtual() == 157){
                    $status = "#EEAD0E";
                }
                
                if ($servidor->getCargo() == 110){
                    $status = "blue";
                }
                
//                $button_mais_informacoes = "<a id='btn_mais_informacoes' name='btn-mais-informacoes' href='servidor.php?idinscricao={$item->getIdInscricao()}' class='btn btn-info btn-sm'>Mais Informações</a>";

                $linhas .= '<tr >
                                  <th scope="row"><font color="'.$status.'">'.$item->getIdInscricao().'</font></th>
                                  <td><font color="'.$status.'">'.$item->getNomeServidor().'</font></td>
                                  <td><font color="'.$status.'">'.$item->getCpfServidor().'</font></td>
                                  <td><font color="'.$status.'">'.$objUnidade->selectObj($item->getUnidadeAtual())->getNome_unidade().'</font></td>                              
                                  <td><font color="'.$status.'">'.$objCargo->selectObj($item->getCargo())->getNome_cargo().'</font></td>                              
                                  <td><font color="'.$status.'">'.$objFuncao->selectObj($item->getFuncao())->getNome_funcao().'</font></td>  
                                  <td><font color="'.$status.'">'.$objUnidade->selectObj($item->getUnidadeDesejo1())->getNome_unidade().'</font></td>        
                                  <td><font color="'.$status.'">'.$pontuacao.'</font></td> 
                            </tr>
                            ';
                
                $qtdInscritos++;
            }

            $meu_html .= '<!DOCTYPE html>
                    <html>'.
            $this->getHeader()
                     . '<body style=" font-size: 10pt;">
                      <p><address><strong>PREFEITURA MUNICIPAL DO NATAL</strong><br/>                            
                                <strong>Secretaria Municipal de Saúde - SMS</strong><br />
                                R. Fabrício Pedroza, 915 <br />
                                CEP: 59014-030 - Area Preta, Natal - RN <br />                                
                            </address>
                       </p>
                     <hr />
                        <div class="col-lg-12">                  
                          <h3 class="h4">Relatório Inscritos '.$subtitle.'<br>Quantidade de Inscritos: '.$qtdInscritos.'</h3>
                          <div class="table-responsive">                       
                            <table class="table table-striped table-hover table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>SERVIDOR</th>                              
                                  <th>CPF</th>                              
                                  <th>UNIDADE ATUAL</th>                              
                                  <th>CARGO</th>                              
                                  <th>FUNÇÃO</th>    
                                  <th>1° UNIDADE DESEJO</th>      
                                  <th>PONTUAÇÃO</th>
                                </tr>
                              </thead>
                              <tbody>
                                   '.$linhas.'            
                              </tbody>
                            </table>
                          </div>
                   </div>
                  </body>
                    </html>';
//        }
                      
//        }
//            echo $meu_html;
        return $meu_html;
    }
    
    private function getMpdf($unidade = null, $cargo = null, $funcao = null){
                
        $html = $this->getHtml($unidade, $cargo, $funcao);
        $sistema = new Sistema();
        $mpdf=new mPDF('c','A4');
            $mpdf->SetHeader("{$sistema->getCompany()} || {$sistema->getName()}  ");
           //  $mpdf->SetHeader("{$sistema->getCompany()} || {$sistema->getName()}  ");
            $mpdf->AddPage('L');
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->setFooter("Relatório de Inscritos | Gerado em: ".  date("d/m/Y H:i:s") ." | Página: {PAGENO}") ;

            $mpdf->WriteHTML($html);

            $mpdf->Output("relInscricao.pdf","I");
    }
    
    
}
