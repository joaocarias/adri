<?php

include_once '../lib/View.php';
require_once("../lib/MPDF57/mpdf.php");
include_once '../lib/Sistema.php';
include_once '../lib/Auxiliar.php';
include_once '../app/model/Inscricao.php';
include_once '../app/model/Cargo.php';
include_once '../app/model/Funcao.php';
include_once '../app/model/Unidade.php';

/**
 * Description of InscricaoPrintView
 *
 * @author joao.franca
 */
class InscricaoPrintView extends View {
    public function get($action = null, $params = null){
        
       $hi_id = filter_input(INPUT_POST, 'hi_id', FILTER_SANITIZE_STRING);
       $this->getMpdf($hi_id);              
       
    }
    
    private function getHtml($idInscricao = null){
        $meu_html = "";
        
        if(!is_null($idInscricao)){
            
            $obj = new Inscricao();
            $inscrito = $obj->selectObj($idInscricao); 
            
            $objCargo = new Cargo();
            $cargo = $objCargo->selectObj($inscrito->getCargo());
            
            $objFuncao = new Funcao();
            $funcao = $objFuncao->selectObj($inscrito->getFuncao());
            
            $objUnidade = new Unidade();
            $uniAtual = $objUnidade->selectObj($inscrito->getUnidadeAtual());
            $uniVai1 = $objUnidade->selectObj($inscrito->getUnidadeDesejo1());
            $uniVai2 = $objUnidade->selectObj($inscrito->getUnidadeDesejo2());
            $uniVai3 = $objUnidade->selectObj($inscrito->getUnidadeDesejo3());
            
            $meu_html .= '<!DOCTYPE html>
                    <html>      
                      <body>
                      <p><address><strong>PREFEITURA MUNICIPAL DO NATAL</strong><br/>                            
                                <strong>Secretaria Municipal de Saúde - SMS</strong><br />
                                R. Fabrício Pedroza, 915 <br />
                                CEP: 59014-030 - Area Preta, Natal - RN <br />                                
                            </address>
                       </p>
                      <hr />
                        <strong>DADOS DA INSCRIÇÃO</strong>
                     <hr />
                        <table class="table">     
                            <tr><td>Data de Inscrição</td><td>'. Auxiliar::converterDataTimeBR($inscrito->getDataSolicitacao()).'</td></tr>'
                             .'<tr><td>Nome:</td> <td>'.$inscrito->getNomeServidor().'</td></tr>'
                    . '<tr><td>CPF:</td> <td> '.$inscrito->getCpfServidor().'</td></tr>'
                    . '<tr><td>CEP:</td> <td> '.$inscrito->getCep().'</td></tr>'
                    . '<tr><td>Endereço:</td> <td> '.$inscrito->getEndereco().'</td></tr>'
                    . '<tr><td>Telefone:</td> <td> '.$inscrito->getTelefone().'</td></tr>'
                    . '<tr><td>Email:</td> <td> '.$inscrito->getEmail().'</td></tr>'
                    . '<tr><td>Cargo:</td> <td> '.$cargo->getNome_cargo().'</td></tr>'
                    . '<tr><td>Função:</td> <td> '.$funcao->getNome_funcao().'</td></tr>'
                    . '<tr><td>Unidade Atual:</td> <td> '.$uniAtual->getNome_unidade().'</td></tr>'
                    . '<tr><td>Chegada na Unid. Atual:</td> <td> '. Auxiliar::converterDataParaBR($inscrito->getDataChegadaAtual()).'</td></tr>'
                    . '<tr><td>Motivo da Solicitação:</td> <td> '.$inscrito->getMotivoSolicitacao().'</td></tr>'
                    . '<tr><td>Experiência em Saúde:</td> <td> '.$inscrito->getExperienciaSaude().'</td></tr>'
                    
                    . '<tr><td>Unidade de Desejo 1:</td> <td> '.$uniVai1->getNome_unidade().'</td></tr>'
                    . '<tr><td>Unidade de Desejo 2:</td> <td> '.$uniVai2->getNome_unidade().'</td></tr>'
                    . '<tr><td>Unidade de Desejo 3:</td> <td> '.$uniVai3->getNome_unidade().'</td></tr>';
                    
                    if(!empty($inscrito->getUnidadeAnterior1())){
                        $uniFoi1 = $objUnidade->selectObj($inscrito->getUnidadeAnterior1());
                        $uniFoi2 = $objUnidade->selectObj($inscrito->getUnidadeAnterior2());
                        $uniFoi3 = $objUnidade->selectObj($inscrito->getUnidadeAnterior3());
                        
                        $meu_html.= '<tr><td>Unidade Anterior 1:</td> <td> '.$uniFoi1->getNome_unidade().'</td></tr>'
                                . '<tr><td>Data Chegada Unidade Anterior 1:</td> <td> '.Auxiliar::converterDataParaBR($inscrito->getChegadaUnidadeAnterior1()).'</td></tr>'
                                . '<tr><td>Data Saida Unidade Anterior 1:</td> <td> '.Auxiliar::converterDataParaBR($inscrito->getSaidaUnidadeAnterior1()).'</td></tr>'
                                . '<tr><td>Motivo Saida Unidade Anterior 1:</td> <td> '.$inscrito->getLabelMotivoAnterior($inscrito->getMotivoUnidadeAnterior1()).'</td></tr>';
                    }  
                    if(!empty($inscrito->getUnidadeAnterior2())){
                        $uniFoi2 = $objUnidade->selectObj($inscrito->getUnidadeAnterior2());
                        
                        $meu_html .= '<tr><td>Unidade Anterior 2:</td> <td> '.$uniFoi2->getNome_unidade().'</td></tr>'
                                . '<tr><td>Data Chegada Unidade Anterior 2:</td> <td> '.Auxiliar::converterDataParaBR($inscrito->getChegadaUnidadeAnterior2()).'</td></tr>'
                                . '<tr><td>Data Saida Unidade Anterior 2:</td> <td> '.Auxiliar::converterDataParaBR($inscrito->getSaidaUnidadeAnterior2()).'</td></tr>'
                                . '<tr><td>Motivo Saida Unidade Anterior 2:</td> <td> '.$inscrito->getLabelMotivoAnterior($inscrito->getMotivoUnidadeAnterior2()).'</td></tr>';
                    }
                    if(!empty($inscrito->getUnidadeAnterior3())){
                        $uniFoi3 = $objUnidade->selectObj($inscrito->getUnidadeAnterior3());
                        
                        $meu_html .= '<tr><td>Unidade Anterior 3:</td> <td> '.$uniFoi3->getNome_unidade().'</td></tr>'
                                . '<tr><td>Data Chegada Unidade Anterior 3:</td> <td> '.Auxiliar::converterDataParaBR($inscrito->getChegadaUnidadeAnterior3()).'</td></tr>'
                                . '<tr><td>Data Saida Unidade Anterior 3:</td> <td> '.Auxiliar::converterDataParaBR($inscrito->getSaidaUnidadeAnterior3()).'</td></tr>'
                                . '<tr><td>Motivo Saida Unidade Anterior 3:</td> <td> '.$inscrito->getLabelMotivoAnterior($inscrito->getMotivoUnidadeAnterior3()).'</td></tr>';
                    }
                    $meu_html .=' </table>
                        <hr />
                        <strong>CONTATO</strong> <br />
                        <address><strong>NCL - Núcleo de Cadastro de Lotação</strong> <br />
                            Telefone: 84-3232-8163 <br>
                            E-Mail:  <a href="mailto:ncl_dgtes@outlook.com"> ncl_dgtes@outlook.com </a>
                        </address>
                     <hr />
                      </body>
                    </html>';      
        }
        return $meu_html;
    }
    
    private function getMpdf($idInscricao = null){
                
        $html = $this->getHtml($idInscricao);
        $sistema = new Sistema();
        $mpdf=new mPDF('c','A4');
            $mpdf->SetHeader("{$sistema->getCompany()} || {$sistema->getName()}  ");
           //  $mpdf->SetHeader("{$sistema->getCompany()} || {$sistema->getName()}  ");
            $mpdf->AddPage('P');
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->setFooter("COD: $idInscricao | Gerado em: ".  date("d/m/Y H:i:s") ." | Página: {PAGENO}") ;

            $mpdf->WriteHTML($html);

            $mpdf->Output("inscricao.pdf","I");
    }
    
    
}
