

       
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popup">
                        Afficher le pop-up
                    </button>
                    <div id="popup" class="modal">
                        <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <ul class="nav nav-tabs mb-2" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                                        <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">Info Profesionnel</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                                                    <form action="php/insert_client_societe.php" method="POST">
                                                        <input type="hidden" name="cat" value="Professionnel">
                                                                        <div class="row">
                                                                            <div class="col-12 col-sm-6">
                                                                                <div class="form-group">
                                                                                    <div class="controls">
                                                                                        <label>*Nom de la société :</label>
                                                                                        <input name="name_client" type="text" class="form-control" placeholder="Nom de la société" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="controls">
                                                                                        <label>Numéros Siret :</label>
                                                                                        <input name="numsiret" type="text" class="form-control" placeholder="N°Siret">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-group">
                                                                                        <div class="controls">
                                                                                            <label>TVA Intracom :</label>
                                                                                            <input name="tvaintracom" type="text" class="form-control" placeholder="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="controls">
                                                                                            <label>Iban :</label>
                                                                                            <input placeholder="FR-" name="iban" type="text" class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    <label>*Secteur d'activité :</label>
                                                                                    <fieldset class="invoice-address form-group">
                                                                                        <select name="secteur" class="form-control invoice-item-select" required>
                                                                                            <option></option>
                                                                                            <option value="Agroalimentaire">Agroalimentaire</option>
                                                                                            <option value="Bois / Papier / Carton / Imprimerie">Bois / Papier / Carton / Imprimerie</option>
                                                                                            <option value="Chimie / Parachimie">Chimie / Parachimie</option>
                                                                                            <option value="Électronique / Électricité">Électronique / Électricité</option>
                                                                                            <option value="Industrie pharmaceutique">Industrie pharmaceutique</option>
                                                                                            <option value="Machines et équipements / Automobile">Machines et équipements / Automobile</option>
                                                                                            <option value="Plastique / Caoutchouc">Plastique / Caoutchouc</option>
                                                                                            <option value="Textile / Habillement / Chaussure">Textile / Habillement / Chaussure</option>
                                                                                            <option value="Banque / Assurance">Banque / Assurance</option>
                                                                                            <option value="BTP / Matériaux de construction">BTP / Matériaux de construction</option>
                                                                                            <option value="Commerce / Négoce / Distribution">Commerce / Négoce / Distribution</option>
                                                                                            <option value="Édition / Communication / Multimédia">Édition / Communication / Multimédia</option>
                                                                                            <option value="Études et conseils">Études et conseils</option>
                                                                                            <option value="Informatique / Télécoms">Informatique / Télécoms</option>
                                                                                            <option value="Métallurgie / Travail du métal">Métallurgie / Travail du métal</option>
                                                                                            <option value="Transports / Logistique">Transports / Logistique</option>
                                                                                            <option value="Services aux entreprises">Services aux entreprises</option>
                                                                                            <option value="Autres">Autres</option>
                                                                                        </select>
                                                                                    </fieldset>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Numéro de téléphone :</label>
                                                                                    <input name="tel" type="text" class="form-control" placeholder="Numéros de téléphone de la société">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="controls">
                                                                                        <label>*Email :</label>
                                                                                        <input name="email" type="text" class="form-control" placeholder="Email de la société">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Siteweb de la société :</label>
                                                                                    <input name="siteweb" type="text" class="form-control" placeholder="www.monclientsociete.fr">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="controls">
                                                                                        <label>*Adresse :</label>
                                                                                        <input name="adresse" type="text" class="form-control" placeholder="Adresse du siege client" required data-validation-required-message="L'e-mail de la societe obligatoire">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="controls">
                                                                                        <label>*Pays :</label>
                                                                                        <fieldset class="invoice-address form-group">
                                                                                            <select name="pays" class="form-control invoice-item-select" required>
                                                                                                <option></option>
                                                                                                <optgroup label="Europe">
                                                                                                <option value="allemagne">Allemagne</option>
                                                                                                <option value="albanie">Albanie</option>
                                                                                                <option value="andorre">Andorre</option>
                                                                                                <option value="autriche">Autriche</option>
                                                                                                <option value="bielorussie">Biélorussie</option>
                                                                                                <option value="belgique">Belgique</option>
                                                                                                <option value="bosnieHerzegovine">Bosnie-Herzégovine</option>
                                                                                                <option value="bulgarie">Bulgarie</option>
                                                                                                <option value="croatie">Croatie</option>
                                                                                                <option value="danemark">Danemark</option>
                                                                                                <option value="espagne">Espagne</option>
                                                                                                <option value="estonie">Estonie</option>
                                                                                                <option value="finlande">Finlande</option>
                                                                                                <option value="france" selected>France</option>
                                                                                                <option value="grece">Grèce</option>
                                                                                                <option value="hongrie">Hongrie</option>
                                                                                                <option value="irlande">Irlande</option>
                                                                                                <option value="islande">Islande</option>
                                                                                                <option value="italie">Italie</option>
                                                                                                <option value="lettonie">Lettonie</option>
                                                                                                <option value="liechtenstein">Liechtenstein</option>
                                                                                                <option value="lituanie">Lituanie</option>
                                                                                                <option value="luxembourg">Luxembourg</option>
                                                                                                <option value="exRepubliqueYougoslaveDeMacedoine">Ex-République Yougoslave de Macédoine</option>
                                                                                                <option value="malte">Malte</option>
                                                                                                <option value="moldavie">Moldavie</option>
                                                                                                <option value="monaco">Monaco</option>
                                                                                                <option value="norvege">Norvège</option>
                                                                                                <option value="paysBas">Pays-Bas</option>
                                                                                                <option value="pologne">Pologne</option>
                                                                                                <option value="portugal">Portugal</option>
                                                                                                <option value="roumanie">Roumanie</option>
                                                                                                <option value="royaumeUni">Royaume-Uni</option>
                                                                                                <option value="russie">Russie</option>
                                                                                                <option value="saintMarin">Saint-Marin</option>
                                                                                                <option value="serbieEtMontenegro">Serbie-et-Monténégro</option>
                                                                                                <option value="slovaquie">Slovaquie</option>
                                                                                                <option value="slovenie">Slovénie</option>
                                                                                                <option value="suede">Suède</option>
                                                                                                <option value="suisse">Suisse</option>
                                                                                                <option value="republiqueTcheque">République Tchèque</option>
                                                                                                <option value="ukraine">Ukraine</option>
                                                                                                <option value="vatican">Vatican</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Afrique">
                                                                                                <option value="afriqueDuSud">Afrique Du Sud</option>
                                                                                                <option value="algerie">Algérie</option>
                                                                                                <option value="angola">Angola</option>
                                                                                                <option value="benin">Bénin</option>
                                                                                                <option value="botswana">Botswana</option>
                                                                                                <option value="burkina">Burkina</option>
                                                                                                <option value="burundi">Burundi</option>
                                                                                                <option value="cameroun">Cameroun</option>
                                                                                                <option value="capVert">Cap-Vert</option>
                                                                                                <option value="republiqueCentre-Africaine">République Centre-Africaine</option>
                                                                                                <option value="comores">Comores</option>
                                                                                                <option value="republiqueDemocratiqueDuCongo">République Démocratique Du Congo</option>
                                                                                                <option value="congo">Congo</option>
                                                                                                <option value="coteIvoire">Côte d'Ivoire</option>
                                                                                                <option value="djibouti">Djibouti</option>
                                                                                                <option value="egypte">Égypte</option>
                                                                                                <option value="ethiopie">Éthiopie</option>
                                                                                                <option value="erythrée">Érythrée</option>
                                                                                                <option value="gabon">Gabon</option>
                                                                                                <option value="gambie">Gambie</option>
                                                                                                <option value="ghana">Ghana</option>
                                                                                                <option value="guinee">Guinée</option>
                                                                                                <option value="guinee-Bisseau">Guinée-Bisseau</option>
                                                                                                <option value="guineeEquatoriale">Guinée Équatoriale</option>
                                                                                                <option value="kenya">Kenya</option>
                                                                                                <option value="lesotho">Lesotho</option>
                                                                                                <option value="liberia">Liberia</option>
                                                                                                <option value="libye">Libye</option>
                                                                                                <option value="madagascar">Madagascar</option>
                                                                                                <option value="malawi">Malawi</option>
                                                                                                <option value="mali">Mali</option>
                                                                                                <option value="maroc">Maroc</option>
                                                                                                <option value="maurice">Maurice</option>
                                                                                                <option value="mauritanie">Mauritanie</option>
                                                                                                <option value="mozambique">Mozambique</option>
                                                                                                <option value="namibie">Namibie</option>
                                                                                                <option value="niger">Niger</option>
                                                                                                <option value="nigeria">Nigeria</option>
                                                                                                <option value="ouganda">Ouganda</option>
                                                                                                <option value="rwanda">Rwanda</option>
                                                                                                <option value="saoTomeEtPrincipe">Sao Tomé-et-Principe</option>
                                                                                                <option value="senegal">Séngal</option>
                                                                                                <option value="seychelles">Seychelles</option>
                                                                                                <option value="sierra">Sierra</option>
                                                                                                <option value="somalie">Somalie</option>
                                                                                                <option value="soudan">Soudan</option>
                                                                                                <option value="swaziland">Swaziland</option>
                                                                                                <option value="tanzanie">Tanzanie</option>
                                                                                                <option value="tchad">Tchad</option>
                                                                                                <option value="togo">Togo</option>
                                                                                                <option value="tunisie">Tunisie</option>
                                                                                                <option value="zambie">Zambie</option>
                                                                                                <option value="zimbabwe">Zimbabwe</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Amérique">
                                                                                                <option value="antiguaEtBarbuda">Antigua-et-Barbuda</option>
                                                                                                <option value="argentine">Argentine</option>
                                                                                                <option value="bahamas">Bahamas</option>
                                                                                                <option value="barbade">Barbade</option>
                                                                                                <option value="belize">Belize</option>
                                                                                                <option value="bolivie">Bolivie</option>
                                                                                                <option value="bresil">Brésil</option>
                                                                                                <option value="canada">Canada</option>
                                                                                                <option value="chili">Chili</option>
                                                                                                <option value="colombie">Colombie</option>
                                                                                                <option value="costaRica">Costa Rica</option>
                                                                                                <option value="cuba">Cuba</option>
                                                                                                <option value="republiqueDominicaine">République Dominicaine</option>
                                                                                                <option value="dominique">Dominique</option>
                                                                                                <option value="equateur">Équateur</option>
                                                                                                <option value="etatsUnis">États Unis</option>
                                                                                                <option value="grenade">Grenade</option>
                                                                                                <option value="guatemala">Guatemala</option>
                                                                                                <option value="guyana">Guyana</option>
                                                                                                <option value="haiti">Haïti</option>
                                                                                                <option value="honduras">Honduras</option>
                                                                                                <option value="jamaique">Jamaïque</option>
                                                                                                <option value="mexique">Mexique</option>
                                                                                                <option value="nicaragua">Nicaragua</option>
                                                                                                <option value="panama">Panama</option>
                                                                                                <option value="paraguay">Paraguay</option>
                                                                                                <option value="perou">Pérou</option>
                                                                                                <option value="saintCristopheEtNieves">Saint-Cristophe-et-Niévès</option>
                                                                                                <option value="sainteLucie">Sainte-Lucie</option>
                                                                                                <option value="saintVincentEtLesGrenadines">Saint-Vincent-et-les-Grenadines</option>
                                                                                                <option value="salvador">Salvador</option>
                                                                                                <option value="suriname">Suriname</option>
                                                                                                <option value="triniteEtTobago">Trinité-et-Tobago</option>
                                                                                                <option value="uruguay">Uruguay</option>
                                                                                                <option value="venezuela">Venezuela</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Asie">
                                                                                                <option value="afghanistan">Afghanistan</option>
                                                                                                <option value="arabieSaoudite">Arabie Saoudite</option>
                                                                                                <option value="armenie">Arménie</option>
                                                                                                <option value="azerbaidjan">Azerbaïdjan</option>
                                                                                                <option value="bahrein">Bahreïn</option>
                                                                                                <option value="bangladesh">Bangladesh</option>
                                                                                                <option value="bhoutan">Bhoutan</option>
                                                                                                <option value="birmanie">Birmanie</option>
                                                                                                <option value="brunei">Brunéi</option>
                                                                                                <option value="cambodge">Cambodge</option>
                                                                                                <option value="chine">Chine</option>
                                                                                                <option value="coreeDuSud">Corée Du Sud</option>
                                                                                                <option value="coreeDuNord">Corée Du Nord</option>
                                                                                                <option value="emiratsArabeUnis">Émirats Arabe Unis</option>
                                                                                                <option value="georgie">Géorgie</option>
                                                                                                <option value="inde">Inde</option>
                                                                                                <option value="indonesie">Indonésie</option>
                                                                                                <option value="iraq">Iraq</option>
                                                                                                <option value="iran">Iran</option>
                                                                                                <option value="israel">Israël</option>
                                                                                                <option value="japon">Japon</option>
                                                                                                <option value="jordanie">Jordanie</option>
                                                                                                <option value="kazakhstan">Kazakhstan</option>
                                                                                                <option value="kirghistan">Kirghistan</option>
                                                                                                <option value="koweit">Koweït</option>
                                                                                                <option value="laos">Laos</option>
                                                                                                <option value="liban">Liban</option>
                                                                                                <option value="malaisie">Malaisie</option>
                                                                                                <option value="maldives">Maldives</option>
                                                                                                <option value="mongolie">Mongolie</option>
                                                                                                <option value="nepal">Népal</option>
                                                                                                <option value="oman">Oman</option>
                                                                                                <option value="ouzbekistan">Ouzbékistan</option>
                                                                                                <option value="pakistan">Pakistan</option>
                                                                                                <option value="philippines">Philippines</option>
                                                                                                <option value="qatar">Qatar</option>
                                                                                                <option value="singapour">Singapour</option>
                                                                                                <option value="sriLanka">Sri Lanka</option>
                                                                                                <option value="syrie">Syrie</option>
                                                                                                <option value="tadjikistan">Tadjikistan</option>
                                                                                                <option value="taiwan">Taïwan</option>
                                                                                                <option value="thailande">Thaïlande</option>
                                                                                                <option value="timorOriental">Timor oriental</option>
                                                                                                <option value="turkmenistan">Turkménistan</option>
                                                                                                <option value="turquie">Turquie</option>
                                                                                                <option value="vietNam">Viêt Nam</option>
                                                                                                <option value="yemen">Yemen</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Océanie">
                                                                                                <option value="australie">Australie</option>
                                                                                                <option value="fidji">Fidji</option>
                                                                                                <option value="kiribati">Kiribati</option>
                                                                                                <option value="marshall">Marshall</option>
                                                                                                <option value="micronesie">Micronésie</option>
                                                                                                <option value="nauru">Nauru</option>
                                                                                                <option value="nouvelleZelande">Nouvelle-Zélande</option>
                                                                                                <option value="palaos">Palaos</option>
                                                                                                <option value="papouasieNouvelleGuinee">Papouasie-Nouvelle-Guinée</option>
                                                                                                <option value="salomon">Salomon</option>
                                                                                                <option value="samoa">Samoa</option>
                                                                                                <option value="tonga">Tonga</option>
                                                                                                <option value="tuvalu">Tuvalu</option>
                                                                                                <option value="vanuatu">Vanuatu</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Autres pays">
                                                                                                <option value="Autres">Autres</option>
                                                                                                </optgroup>
                                                                                            </select>
                                                                                        </fieldset>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                            <hr>
                                                                            </div>
                                                                            <div class="col-12 col-sm-6">
                                                                                <div class="form-group">
                                                                                    <div class="controls">
                                                                                        <label>*Nom du dirigeant :</label>
                                                                                        <input name="nom_diri" type="text" class="form-control" placeholder="Nom du dirigeant" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>*Prenom du dirigeant :</label>
                                                                                    <input name="prenom" type="text" class="form-control" placeholder="Prénom du dirigeant" required>
                                                                                </div>
                                                                            </div>
                                                                            <input name="numentreprise" type="hidden" value="<?= $entreprise['id'] ?>">
                                                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
                                                                            </div>
                                                                                <label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à completer les champs obligatoires*</label>
                                                                            </div>
                                                                        
                                                                        </div>
                                                            
                                                    </form>
                                                                    
                                                                
                                                           
                                                </div>
                                            </div>
                                                
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <!-- pas toucher en dessous pas de la merde -->
                                        </div>
                                    </div>
                            </div>
                    </div>
                                
            
            
            
            
            
            
            
            
            
            </div>
        </div>
    </div>





































































   
    <!-- END: Page JS-->

