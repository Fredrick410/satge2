

            <!-- Mes documents -->
            <?php
                if($crea['status_crea'] == "EURL"){
                        $linkview = "morale";
                }else{        
                    if($crea['status_crea'] == "SARL"){
                        $linkview = "morale";
                    }else{
                        if($crea['status_crea'] == "SAS"){
                            $linkview = "morale";
                        }else{
                            if($crea['status_crea'] == "SASU"){
                                $linkview = "morale";
                            }else{
                                if($crea['status_crea'] == "SCI"){
                                    $linkview = "morale";
                                }else{
                                    if($crea['status_crea'] == "EIRL"){
                                        $linkview = "physique";
                                    }else{
                                        if($crea['status_crea'] == "Micro-entreprise"){
                                            $linkview = "physique";
                                        }else{
                                            $linkview = "physique";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            if($crea['status_crea'] == ""){
                $noneform = "none-validation";
            }else{
                $noneform = "block-validation";
            }
            ?>
            <div class="col-6 m-0 px-3 pt-2" id="div-document">
                <h2>Mes documents</h2>
                <div class="row p-2" id="doc-manquant">
                    <h4>Document manquant</h4>
                        <div class="col-12" id="scroll-doc">
                            <div class="form-group">
                                <label class="line">Administration</label>
                            </div>  
                            <?php
                                if ($linkview == "morale") {
                                            if($doc_pieceid == "1"){ ?>
                                            <a href="creation-view-morale-pieceid.php" id="av" class="list-group-item" >
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div>
                                                Pièce d'identitée <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-pieceid.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div>
                                                Pièce d'identitée <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_cerfaM0 == "1"){ ?>
                                            <a href="creation-view-morale-cerfaM0.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa M0 <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-cerfaM0.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa M0 <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_cerfaMBE == "1"){ ?>
                                            <a href="creation-view-morale-cerfaMBE.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa MBE <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-cerfaMBE.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa MBE <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_justificatifss == "1"){ ?>
                                            <a href="creation-view-morale-justificatifss.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Justificatif siège social <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-justificatifss.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Justificatif siège social <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label class="line">Rédaction</label>
                                        </div>                                       
                                        <?php 
                                            if($doc_pouvoir == "1"){ ?>
                                            <a href="creation-view-morale-pouvoir.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Pouvoir <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-pouvoir.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Pouvoir <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_attestation == "1"){ ?>
                                            <a href="creation-view-morale-attestation.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Attestation de non condamnation <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-attestation.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Attestation de non condamnation <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label class="line">Banque et Publication</label>
                                        </div>
                                        <?php 
                                            if($doc_depot == "1"){ ?>
                                            <a href="creation-view-morale-depot.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Dépôt de capital <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-depot.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Dépôt de capital <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                            <?php       } 
                                } else { 
                                            if($doc_pieceid == "1"){ ?>  
                                            <a href="creation-view-morale-pieceid.php" id="av" class="list-group-item" >
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div>
                                                Pièce d'identitée <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-pieceid.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div>
                                                Pièce d'identitée <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_cerfaM0 == "1"){ ?>
                                            <a href="creation-view-morale-cerfaM0.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa M0 <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-cerfaM0.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa M0 <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_xp == "1"){ ?>
                                            <a href="creation-view-physique-xp.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Exp professionnel <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-physique-xp.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Exp professionnel <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_justificatifd == "1"){ ?>
                                            <a href="creation-view-physique-justificatifd.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Justificatif domicile <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-physique-justificatifd.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Justificatif domicile <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_peirl == "1"){ ?>
                                            <a href="creation-view-physique-peirl.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                PEIRL <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-physique-peirl.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                PEIRL <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label class="line">Rédaction</label>
                                        </div> 
                                        <?php 
                                            if($doc_affectation == "1"){ ?>
                                            <a href="creation-view-physique-affectation.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Affectation patrimoine <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-physique-affectation.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Affectation patrimoine <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>                                      
                                        <?php }
                                            if($doc_pouvoir == "1"){ ?>
                                            <a href="creation-view-physique-pouvoir.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Pouvoir <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-physique-pouvoir.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Pouvoir <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_attestation == "1"){ ?>
                                            <a href="creation-view-physique-attestation.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Attestation de non condamnation <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-physique-attestation.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Attestation de non condamnation <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>                                        
                            <?php           }
                                } ?>                                        
                        </div>
                </div>
            </div>