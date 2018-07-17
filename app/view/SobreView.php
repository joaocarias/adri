<?php

include_once '../lib/Sistema.php';
include_once '../lib/View.php';

/**
 * Description of SobreView
 *
 * @author joao.franca
 */
class SobreView extends View {
    function __construct($title_page = null, $sistema = null) {
        parent::__construct($title_page, $sistema);        
    }
    
    private function getContent($action = null, $params = null){
        
            $retorno = '<section>' 
                            . $this->getInfoSis()                           
                            . $this->getInfoVersion()                                    
                            . $this->getInfoTemplate()
                       . '</section>';
       
        return $retorno;
    }
            
    public function get($action = null, $params = null){
                   
        return '<!DOCTYPE html>
                    <html>
                      
                    '.$this->getHeader().'
                      
                      <body>
                        <div class="page">
                            '.$this->getNavBar().'
                          <div class="page-content d-flex align-items-stretch"> 
                            <!-- Side Navbar -->
                            '.$this->getMenu().'
                            <div class="content-inner">
                              <!-- Page Header-->
                              '.$this->getPagHeader().'  
                                  
                                  <div class="container-fluid">

                              '.$this->getContent($action, $params).'
                                  
                                  </div>

                              <!-- Page Footer-->
                              '.$this->getFooter().'
                      </body>
                    </html>';
    }
    
    public function getInfoSis(){
        return $this->beginCard("col-lg-12", "ADRIF - Administração de Remanejamento Interno Funcional").' 
                <p><strong>A Secretaria Municipal de Saúde (SMS) do município de Natal – RN</strong> atualmente possui uma rede de Atenção Básica composta por 53 (Cinquenta e três)
                unidades de saúde, distribuídas em cinco distritos sanitários, instituídas por meio de um modelo híbrido de atenção que incluem o modelo, fundamentado na estratégia 
                de saúde da família com 36 (Trinta e seis) unidades de saúde e ainda 17 (dezessete) unidades que atendem através de demandas espontâneas, com base no modelo 
                tradicional do Ministério da Saúde.</p>
                
                <p>A SMS, junto com o <strong>Departamento de Gestão do Trabalho e Educação na Saúde – DGTES</strong> e ao <strong>Setor de Gestão de Tecnologias de Informações
                e Comunicação – SGTIC</strong>, trabalha com diversos Sistemas Web que otimiza os serviços da secretaria, dentre eles o <strong>Sistema de Gerenciamento de Lotação
                do Servidor – SIG-LOS</strong>, que controla e gerencia os cadastros de funcionários e suas lotações, além das funções e cargos exercidos por cada destes funcionários. 
                Contudo, cada sistema é primordial para o desempenho dos serviços na área da saúde, agilizando cada vez mais o trabalho dos servidores, além de gerar um acesso 
                ao histórico (ágil, preciso e persistente) de cada servidor que foi ou se encontra lotado na SMS.</p>
                
                <p>Neste contexto, o DGTES percebeu a necessidade de um novo sistema para otimização no procedimento de remanejamento de funcionários da SMS, priorizando os servidores
                que já estão quadro e desejem mudar de lotação e realizar remanejamentos voluntários. Neste sentido e motivado pela realização do concurso público na área da saúde
                conforme o edital Nº 001/2018, foi proposto o Sistema de <strong>Administração de Remanejamento Interno Funcional – ADRIF</strong> com o objetivo de fortalecer e 
                auxiliar de maneira mais ágil a distribuição das lotações para os aprovados no concurso, além facilitar o remanejamento voluntário de servidores ativos desta 
                secretaria. A partir do momento que os servidores ativos forem remanejado, abrir as vagas para a lotação dos aprovados no concurso acima citado.</p>
                
                <p>O processo básico consiste da solicitação do remanejamento via formulário de intenção voluntária do servidor lotado com determinados critérios para ser preenchido
                e avaliado. Porém, um formulário no papel seria inviável visto pela quantidade de papéis que seria impresso como também pelo tempo para analisar todos os formulários
                preenchidos pelos critérios proposto. Posteriormente, seria feito relatórios destes critérios abordados, com isso levaria muito tempo e não seria rápido o suficiente
                a análise do mesmo, acarretado pelo todo o processo manual. A partir dessas necessidades foi desenvolvido o sistema ADRIF, contendo os formulários para informatizar
                e fácil acesso, além de cria relatórios da análise das competências dos possíveis candidatos ao remanejamento, auxiliando na tomada de decisão dos avaliadores, 
                para saber se o servidor está apto para exercer a função.</p>

                <p>O presente artigo tem como objetivo descrever a experiência de formulação e implantação do sistema web ADRIF nesta secretaria de saúde, uma alternativa para melhoria 
                da gerência de transferência dos funcionários conforme intenção do servidor e necessidade das unidades. Contudo, o ADRIF é um sistema eficaz que atende ao que foi 
                proposto, como também eficiente que cumpre o que foi estabelecido em tempo muito menor comprado aos relatórios que seria realizado manualmente após a análise dos 
                formulários. Visto como, essa alternativa está relacionada ao setor DGTES, como experiência inovadora de implementação para otimização no processo de remanejar 
                servidores para outro local de trabalho.</p>
                
                <p>O sistema web <strong>ADRIF</strong> otimiza e gerencia de forma mais eficaz, eficiente e econômica os requisitos que compõem o processo de transferência dos 
                funcionários para outro local de trabalho. O sistema envolve um formulário com pré-requisitos que avaliam a qualificação e capacitação dos servidores para o local
                de remanejamento desejado. O formulário preenchido pelo funcionário é avaliado pelo chefe imediato (avaliador). Porém, cabe ao avaliador do sistema fazer a análise 
                da solicitação realizada pelo servidor, em que o mesmo atribui notas nas respostas do formulário de requisição e responde perguntas a respeito dos serviços prestados 
                do funcionário, realizando uma análise para o remanejamento servidor seja realizado ou não para outro local. Sendo que essa avaliação do avaliador não é vista pelo 
                funcionário que requisitou mudar o local de trabalho, apenas o resultado final será mostrado para o servidor.</p>  

                <p>Nesta perspectiva, a abertura de vagas para transferência de funcionário constituirá quando houver ampliação do quadro de pessoal ou preencher as vagas que 
                foram ocasionados por demissões, aposentadoria ou remanejamento de funcionário. Nessa visão, é de responsabilidade do DGTES, comunicar aos servidores por meio 
                de edital especificando os critérios para seleção das vagas oferecidas, indicando a quantidade de vagas, os cargos disponíveis, a lotação e o turno disponível. 
                A partir da publicação do edital os servidores tem quantidade específica de dias consecutivos para realizar suas inscrições através do sistema web ADRIF.</p>
                
                <p>Além do mais, uma vez efetivada a seleção e preenchidas as vagas oferecidas será lançado um novo edital com abertura vaga remanescente, isto é, enquanto possuir
                candidatos interessados e que satisfaça a quantidade do quadro de funcionários qualificados para cumprir tais funções especificadas no edital. Nesse contexto, caso 
                não haja candidatos inscritos, a unidade receberá um servidor recém-contratado e/ou aprovados no concurso público da saúde 2018, onde o mesmo será lotado na unidade. 
                Portanto, a inclusão dessa transição dos novos profissionais nas unidades, irá garantir o preenchimento das vagas com finalidade na melhoria da oferta de serviços de 
                saúde à população. </p>
                 '.$this->endCard().'                    
                ';
    }
    
    public function getInfoTemplate(){
        return $this->beginCard("col-lg-12", "Template").'
                <p>O template usado neste projeto foi desenvolvido por <a href="https://bootstrapious.com/admin-templates">Bootstrapious</a>.
                    
                '.$this->endCard().'                    
                ';
    }        
    
    public function getInfoVersion(){
         return $this->beginCard("col-lg-12", "Versão").' 
                    <ul>
                        <li>Versão: '.$this->getSistema()->getVersao().' </li>
                        <li>Ano: '.$this->getSistema()->getAno().' </li>
                        <li>Desenvolvido por: '.$this->getSistema()->getTeam().' </li>                        
                    </ul>
                        
                 '.$this->endCard().'                    
                ';
                 
    }
}
