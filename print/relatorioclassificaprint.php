<?php
session_start();

include_once '../app/view/RelClassificaPrintView.php';

if(!(isset($_SESSION['logado'])) OR  $_SESSION['logado'] != '1'){
    header("location: login.php");
}else{     
    
    $view = new RelClassificaPrintView();    
    $view->get();    
}


//session_start();
//
//require_once("../lib/MPDF57/mpdf.php");
//include_once '../lib/Sistema.php';
//include_once '../app/model/Inscricao.php';
//include_once '../app/model/Cargo.php';
//include_once '../app/model/Funcao.php';
//include_once '../app/model/Unidade.php';
//include_once '../app/model/Servidor.php';
//include_once '../lib/Auxiliar.php';
//
//
//$sistema = new Sistema();
//
//$objInscricao = new Inscricao();
//$inscrito = $objInscricao->selectObjCPF($_SESSION['cpf_servidor']);
//
//$objCargo = new Cargo();
//$cargo = $objCargo->selectObj($inscrito->getCargo());
//
//$objFuncao = new Funcao();
//$funcao = $objFuncao->selectObj($inscrito->getFuncao());
//
//$objUnidade = new Unidade();
//$uniAtual = $objUnidade->selectObj($inscrito->getUnidadeAtual());
//$uniVai1 = $objUnidade->selectObj($inscrito->getUnidadeDesejo1());
//$uniVai2 = $objUnidade->selectObj($inscrito->getUnidadeDesejo2());
//$uniVai3 = $objUnidade->selectObj($inscrito->getUnidadeDesejo3());
//
//$header = '';
//
//$table =  '<table class="table table-sm">' 
//                    . '<tr><th>Dada de Solicitação:</th> <td>'. Auxiliar::converterDataTimeBR($inscrito->getDataSolicitacao()).'</td></tr>'
//                    . '<tr><th scope="row">Nome:</th> <td>'.$inscrito->getNomeServidor().'</td></tr>'                    
//                    . '<tr><th scope="row">CPF:</th> <td> '.$inscrito->getCpfServidor().'</td></tr>'
//                    . '<tr><th scope="row">CEP:</th> <td> '.$inscrito->getCep().'</td></tr>'
//                    . '<tr><th scope="row">Endereço:</th> <td> '.$inscrito->getEndereco().'</td></tr>'
//                    . '<tr><th scope="row">Telefone:</th> <td> '.$inscrito->getTelefone().'</td></tr>'
//                    . '<tr><th scope="row">Email:</th> <td> '.$inscrito->getEmail().'</td></tr>'
//                    . '<tr><th scope="row">Cargo:</th> <td> '.$cargo->getNome_cargo().'</td></tr>'
//                    . '<tr><th scope="row">Função:</th> <td> '.$funcao->getNome_funcao().'</td></tr>'
//                    . '<tr><th scope="row">Unidade Atual:</th> <td> '.$uniAtual->getNome_unidade().'</td></tr>'
//                    . '<tr><th scope="row">Data de Chegada na Unidade Atual:</th> <td> '. Auxiliar::converterDataParaBR($inscrito->getDataChegadaAtual()).'</td></tr>'
//                    . '<tr><th scope="row">Motivo da Solicitação:</th> <td> '.$inscrito->getMotivoSolicitacao().'</td></tr>'
//                    . '<tr><th scope="row">Experiência em Saúde:</th> <td> '.$inscrito->getExperienciaSaude().'</td></tr>'
//                    
//                    . '<tr><th scope="row">Unidade de Desejo 1:</th> <td> '.$uniVai1->getNome_unidade().'</td></tr>'
//                    . '<tr><th scope="row">Unidade de Desejo 2:</th> <td> '.$uniVai2->getNome_unidade().'</td></tr>'
//                    . '<tr><th scope="row">Unidade de Desejo 3:</th> <td> '.$uniVai3->getNome_unidade().'</td></tr>';
//                    
//                    if(!empty($inscrito->getUnidadeAnterior1())){
//                        $uniFoi1 = $objUnidade->selectObj($inscrito->getUnidadeAnterior1());
//                        $uniFoi2 = $objUnidade->selectObj($inscrito->getUnidadeAnterior2());
//                        $uniFoi3 = $objUnidade->selectObj($inscrito->getUnidadeAnterior3());
//                        
//                        $table .= '<tr><th scope="row">Unidade Anterior 1:</th> <td> '.$uniFoi1->getNome_unidade().'</td></tr>'
//                                . '<tr><th scope="row">Data Chegada Unidade Anterior 1:</th> <td> '.Auxiliar::converterDataParaBR($inscrito->getChegadaUnidadeAnterior1()).'</td></tr>'
//                                . '<tr><th scope="row">Data Saida Unidade Anterior 1:</th> <td> '.Auxiliar::converterDataParaBR($inscrito->getSaidaUnidadeAnterior1()).'</td></tr>'
//                                . '<tr><th scope="row">Motivo Saida Unidade Anterior 1:</th> <td> '.$inscrito->getLabelMotivoAnterior($inscrito->getMotivoUnidadeAnterior1()).'</td></tr>';
//                    }  
//                    if(!empty($inscrito->getUnidadeAnterior2())){
//                        $uniFoi2 = $objUnidade->selectObj($inscrito->getUnidadeAnterior2());
//                        
//                        $table .= '<tr><th scope="row">Unidade Anterior 2:</th> <td> '.$uniFoi2->getNome_unidade().'</td></tr>'
//                                . '<tr><th scope="row">Data Chegada Unidade Anterior 2:</th> <td> '.Auxiliar::converterDataParaBR($inscrito->getChegadaUnidadeAnterior2()).'</td></tr>'
//                                . '<tr><th scope="row">Data Saida Unidade Anterior 2:</th> <td> '.Auxiliar::converterDataParaBR($inscrito->getSaidaUnidadeAnterior2()).'</td></tr>'
//                                . '<tr><th scope="row">Motivo Saida Unidade Anterior 2:</th> <td> '.$inscrito->getLabelMotivoAnterior($inscrito->getMotivoUnidadeAnterior2()).'</td></tr>';
//                    }
//                    if(!empty($inscrito->getUnidadeAnterior3())){
//                        $uniFoi3 = $objUnidade->selectObj($inscrito->getUnidadeAnterior3());
//                        
//                        $table .= '<tr><th scope="row">Unidade Anterior 3:</th> <td> '.$uniFoi3->getNome_unidade().'</td></tr>'
//                                . '<tr><th scope="row">Data Chegada Unidade Anterior 3:</th> <td> '.Auxiliar::converterDataParaBR($inscrito->getChegadaUnidadeAnterior3()).'</td></tr>'
//                                . '<tr><th scope="row">Data Saida Unidade Anterior 3:</th> <td> '.Auxiliar::converterDataParaBR($inscrito->getSaidaUnidadeAnterior3()).'</td></tr>'
//                                . '<tr><th scope="row">Motivo Saida Unidade Anterior 3:</th> <td> '.$inscrito->getLabelMotivoAnterior($inscrito->getMotivoUnidadeAnterior3()).'</td></tr>';
//                    }
//                    
//                $table .= '</table>';
//
//$html = $table ;
//
//$mpdf=new mPDF('c','A4');
//$mpdf->SetHeader("{$sistema->getCompany()} || {$sistema->getName()}  ");
//$mpdf->AddPage('P');
//$mpdf->SetDisplayMode('fullpage');
//$mpdf->setFooter("COD: {$inscrito->getIdInscricao()} | Gerado em: ".  date("d/m/Y H:i:s") ." | Página: {PAGENO}") ;
//
//$mpdf->WriteHTML($html);
//
//$mpdf->Output("inscricao.pdf","I");