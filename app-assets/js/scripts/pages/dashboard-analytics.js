/*=========================================================================================
    File Name: dashboard-analytics.js
    Description: dashboard analytics page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Frest HTML Admin Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on("load", function() {

    var $primary = '#5A8DEE';
    var $success = '#39DA8A';
    var $danger = '#FF5B5C';
    var $warning = '#FDAC41';
    var $info = '#00CFDD';
    var $label_color = '#475f7b';
    var $primary_light = '#E2ECFF';
    var $danger_light = '#ffeed9';
    var $gray_light = '#828D99';
    var $sub_label_color = "#596778";
    var $radial_bg = "#e7edf3";
    var $black = "#000000";
    var $magenta = "#FF00FF";

    var annee_actuelle = (new Date()).getFullYear();
    var mois_actuel = (new Date()).getMonth();

    /**
     * Remplace le titre, le data-chart et la donut-chart lorsque qu'on change de section entre création, modification et radiation d'entreprise
     * 
     * @param {string} direction // direction de la flêche cliquée
     */
    function traiterClicFleche(direction) {
        
        var annee_juridique = $("#id_select_annee_juridique").children("option:selected").val();
        // On récupère le titre pour savoir dans quelle section on se situe (Radiation, Création ou Modification)
        var titre_juridique = document.getElementById("id_titre_juridique").textContent;

        // On cherche la section dans laquelle on doit se rendre
        if (direction == "gauche") {
            if (titre_juridique == "Radiation d'entreprise") {
                titre_juridique = "Modification d'entreprise";
            } else if (titre_juridique == "Création d'entreprise") {
                titre_juridique = "Radiation d'entreprise";
            } else if (titre_juridique == "Modification d'entreprise") {
                titre_juridique = "Création d'entreprise";
            }
        } else if (direction == "droite")  {
            if (titre_juridique == "Radiation d'entreprise") {
                titre_juridique = "Création d'entreprise";
            } else if (titre_juridique == "Création d'entreprise") {
                titre_juridique = "Modification d'entreprise";
            } else if (titre_juridique == "Modification d'entreprise") {
                titre_juridique = "Radiation d'entreprise";
            }
        }

        // On change le titre de la section
        document.getElementById("id_titre_juridique").innerText = titre_juridique;

        if (titre_juridique == "Radiation d'entreprise") {

            $("#analytics-bar-chart-juridique").empty();
            $("#donut-chart").empty();

            document.getElementById("id_legende_crea").style.display = "none";
            document.getElementById("id_legende_modif").style.display = "none";

        } else if (titre_juridique == "Création d'entreprise") {

            // On remplace les charts actuels de création d'entreprise    
            $("#analytics-bar-chart-juridique").empty();
            
            var analyticsBarChart = new ApexCharts(
                document.querySelector("#analytics-bar-chart-juridique"),
                analyticsBarChartOptions(window["crea_encours_" + annee_juridique], window["crea_valide_" + annee_juridique], " Demande en cours", " Validé")
            );
            analyticsBarChart.render();

            $("#donut-chart").empty();

            var donutChart = new ApexCharts(
                document.querySelector("#donut-chart"),
                donutChartOptionCrea(window["nb_crea_type_" + annee_juridique])
            );

            donutChart.render();

            // On modifie la légende du donut-chart
            document.getElementById("id_legende_modif").style.display = "none";
            document.getElementById("id_legende_crea").style.display = "block";

        } else if (titre_juridique == "Modification d'entreprise") {

            // On remplace les charts actuels de modification d'entreprise
            $("#analytics-bar-chart-juridique").empty();

            var analyticsBarChart = new ApexCharts(
                document.querySelector("#analytics-bar-chart-juridique"),
                analyticsBarChartOptions(window["modif_encours_" + annee_juridique], window["modif_valide_" + annee_juridique], " Demande en cours", " Validé")
            );

            $("#donut-chart").empty();

            analyticsBarChart.render();

            var donutChart = new ApexCharts(
                document.querySelector("#donut-chart"),
                donutChartOptionModif(window["nb_modif_type_" + annee_juridique])
            );

            donutChart.render();

            // On modifie la légende du donut-chart
            document.getElementById("id_legende_crea").style.display = "none";
            document.getElementById("id_legende_modif").style.display = "block";

        }

    }

    // Clic sur la fleche gauche
    $("#id_fleche_gauche_juridique").click(function(e) {
        e.preventDefault();
        traiterClicFleche("gauche");
    });

    // Clic sur la fleche droite
    $("#id_fleche_droite_juridique").click(function(e) {
        e.preventDefault();
        traiterClicFleche("droite");
    });

    // Radial-Success-chart
    // --------------------------------
    var radialSuccessoptions = {
        chart: {
            height: 40,
            width: 40,
            type: "radialBar"
        },
        grid: {
            show: false,
            padding: {
                left: -30,
                right: -30,
                top: 0,
            }
        },
        series: [30],
        colors: [$success],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "30%"
                },
                dataLabels: {
                    showOn: "always",
                    name: {
                        show: false
                    },
                    value: {
                        show: false,
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                gradientToColors: [$success],
                opacityFrom: 1,
                opacityTo: 0.8,
                stops: [0, 70, 100]
            }
        },
        stroke: {
            lineCap: "round",
        }
    };
    var radialSuccessChart = new ApexCharts(
        document.querySelector("#radial-success-chart"),
        radialSuccessoptions
    );
  
    radialSuccessChart.render();
  
    // Radial-Warning-chart
    // --------------------------------
    var radialWarningoptions = {
        chart: {
            height: 40,
            width: 40,
            type: "radialBar"
        },
        grid: {
            show: false,
            padding: {
                left: -30,
                right: -30,
                top: 0,
            }
        },
        series: [80],
        colors: [$warning],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "30%"
                },
                dataLabels: {
                    showOn: "always",
                    name: {
                        show: false
                    },
                    value: {
                        show: false,
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                gradientToColors: [$warning],
                opacityFrom: 1,
                opacityTo: 0.8,
                stops: [0, 70, 100]
            }
        },
        stroke: {
            lineCap: "round",
        }
    };
    var radialWarningChart = new ApexCharts(
        document.querySelector("#radial-warning-chart"),
        radialWarningoptions
    );
  
    radialWarningChart.render();
  
    // Radial-Danger-chart
    // --------------------------------
    var radialDangeroptions = {
        chart: {
            height: 40,
            width: 40,
            type: "radialBar",
        },
        grid: {
            show: false,
            padding: {
                left: -30,
                right: -30,
                top: 0,
            }
        },
        series: [50],
        colors: [$danger],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "30%"
                },
                dataLabels: {
                    showOn: "always",
                    name: {
                        show: false
                    },
                    value: {
                        show: false,
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                gradientToColors: [$danger],
                opacityFrom: 1,
                opacityTo: 0.8,
                stops: [0, 70, 100]
            }
        },
        stroke: {
            lineCap: "round",
        }
    };
    var radialDangerChart = new ApexCharts(
        document.querySelector("#radial-danger-chart"),
        radialDangeroptions
    );
  
    radialDangerChart.render();
  
    // Bar Chart
    // ---------
 
    function analyticsBarChartOptions(array_1, array_2, legende_1, legende_2) {
        
        var analyticsBarChartOptions = {
            chart: {
                height: 260,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '20%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            colors: [$primary, $primary_light],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: "vertical",
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 70, 100]
                },
            },
            series: [{
                name: legende_1,
                data: [array_1[0], array_1[1], array_1[2], array_1[3], array_1[4], array_1[5], array_1[6], array_1[7], array_1[8], array_1[9], array_1[10], array_1[11]]
            }, {
                name: legende_2,
                data: [array_2[0], array_2[1], array_2[2], array_2[3], array_2[4], array_2[5], array_2[6], array_2[7], array_2[8], array_2[9], array_2[10], array_2[11]]
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: $gray_light
                    }
                }
            },
            yaxis: {
                tickAmount: 3,
                labels: {
                    style: {
                        color: $gray_light
                    },
                    formatter: function(val) {
                        return val.toFixed(0);
                    }
    
                }
            },
            legend: {
                show: true,
                offsetY: -10,
                horizontalAlign: 'left',
                markers: {
                    height: 15,
                    width: 4
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " personnes"
                    }
                }
            }
        }

        return analyticsBarChartOptions
    }

    // DEBUT COMPTA
  
    // Charge le chart de l'année en cours
    var analyticsBarChart = new ApexCharts(
        document.querySelector("#analytics-bar-chart-compta"),
        analyticsBarChartOptions(nb_actif_2021, nb_passif_2021, " Nombre valide", " Passif")
    ); 
    analyticsBarChart.render();

    // S'éxecute lorsqu'on change l'année du select dans Comptabilité
    $("#id_select_annee_portefeuille").change(function() {
    
        var annee_portefeuille = $("#id_select_annee_portefeuille").children("option:selected").val();
      
        // On remplace le graphique par rapport à l'année sélectionnée
        $("#analytics-bar-chart-compta").empty(); 
        var analyticsBarChart = new ApexCharts(
            document.querySelector("#analytics-bar-chart-compta"),
            analyticsBarChartOptions(window["nb_actif_" + annee_portefeuille], window["nb_passif_" + annee_portefeuille], " Nombre valide", " Passif")
        );
        analyticsBarChart.render();
      
    });

    // FIN COMPTA

    // DEBUT JURIDIQUE

    // Charge le chart de l'année en cours
    var analyticsBarChart = new ApexCharts(
        document.querySelector("#analytics-bar-chart-juridique"),
        analyticsBarChartOptions(window["crea_encours_" + annee_actuelle], window["crea_valide_" + annee_actuelle], " Demande en cours", " Validé")
    );
    analyticsBarChart.render();
    
    // S'éxecute lorsqu'on change l'année du select dans Juridique
    $("#id_select_annee_juridique").change(function() {

        // On récupère le titre pour savoir dans quelle section on se situe (Radiation, Création ou Modification)
        var titre_juridique = document.getElementById("id_titre_juridique").textContent;
        // On récupère l'année selectionnée
        var annee_juridique = $(this).children("option:selected").val();

        if (titre_juridique == "Radiation d'entreprise") {

            // A VENIR

        } else if (titre_juridique == "Création d'entreprise") {
        
            // On remplace le graphique par rapport à l'année sélectionnée
            $("#analytics-bar-chart-juridique").empty();

            var analyticsBarChart = new ApexCharts(
                document.querySelector("#analytics-bar-chart-juridique"),
                analyticsBarChartOptions(window["crea_encours_" + annee_juridique], window["crea_valide_" + annee_juridique], " Demande en cours", " Validé")
            );

            analyticsBarChart.render();

        } else if (titre_juridique == "Modification d'entreprise") {

            // On remplace le graphique par rapport à l'année sélectionnée
            $("#analytics-bar-chart-juridique").empty();

            var analyticsBarChart = new ApexCharts(
                document.querySelector("#analytics-bar-chart-juridique"),
                analyticsBarChartOptions(window["modif_encours_" + annee_juridique], window["modif_valide_" + annee_juridique], " Demande en cours", " Validé")
            );

            analyticsBarChart.render();

        }
      
    });

    // FIN JURIDIQUE

    // Success Line Chart
    // -----------------------------
    var successLineChartOption = {
        chart: {
            height: 100,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        grid: {
            show: false,
            padding: {
                bottom: -20,
            }
        },
        colors: [$success],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 3,
            curve: 'smooth'
        },
        series: [{
            data: [50, 0, 50, 40, 90, 0, 40, 25, 80, 40, 45]
        }],
        xaxis: {
            show: false,
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            }
        },
        yaxis: {
            show: false
        },
    }
  
    var successLineChart = new ApexCharts(
        document.querySelector("#success-line-chart"),
        successLineChartOption
    );
    successLineChart.render();
  
    // Donut Chart
    // ---------------------

    function donutChartOptionCrea(array) {
    
        var donutChartOption = {
            chart: {
            width: 300,
            type: 'donut',
            },
            dataLabels: {
            enabled: false
            },
            series: [array['SARL'], array['SAS'], array['SASU'], array['SCI'], array['EIRL'], array['EI'], array['Micr']],
            labels: ["SARL", "SAS", "SASU", "SCI", "EIRL", "EI", "Micro-Entreprise"],
            stroke: {
            width: 0,
            lineCap: 'round',
            },
            colors: [$success, $primary, $warning, $danger, $info, $gray_light, $black],
            plotOptions: {
            pie: {
                donut: {
                size: '80%',
                labels: {
                    show: true,
                    name: {
                    show: true,
                    fontSize: '15px',
                    colors: $sub_label_color,
                    offsetY: 20,
                    fontFamily: 'IBM Plex Sans',
                    },
                    value: {
                    show: true,
                    fontSize: '35px',
                    fontFamily: 'Rubik',
                    color: $label_color,
                    offsetY: -20,
                    formatter: function (val) {
                        return val
                    }
                    },
                    total: {
                    show: true,
                    label: 'Entreprises',
                    color: $gray_light,
                    formatter: function (w) {
                        return w.globals.seriesTotals.reduce(function (a, b) {
                        return a + b
                        }, 0)
                    }
                    }
                }
                }
            }
            },
            legend: {
            show: false
            }
        }
        return donutChartOption;

    }

    function donutChartOptionModif(array) {
    
        var donutChartOption = {
            chart: {
            width: 300,
            type: 'donut',
            },
            dataLabels: {
            enabled: false
            },
            series: [array['one'], array['two'], array['three'], array['four'], array['five'], array['six'], array['seven'], array['eight']],
            labels: ["Cession de parts / Actions", "Gérant / Président", "Siège social", "Objet social", "Forme juridique", "Dénomination", "Capital social", "Veille"],
            stroke: {
            width: 0,
            lineCap: 'round',
            },
            colors: [$success, $primary, $warning, $danger, $info, $gray_light, $black, $magenta],
            plotOptions: {
            pie: {
                donut: {
                size: '80%',
                labels: {
                    show: true,
                    name: {
                    show: true,
                    fontSize: '15px',
                    colors: $sub_label_color,
                    offsetY: 20,
                    fontFamily: 'IBM Plex Sans',
                    },
                    value: {
                    show: true,
                    fontSize: '35px',
                    fontFamily: 'Rubik',
                    color: $label_color,
                    offsetY: -20,
                    formatter: function (val) {
                        return val
                    }
                    },
                    total: {
                    show: true,
                    label: 'Changements',
                    color: $gray_light,
                    formatter: function (w) {
                        return w.globals.seriesTotals.reduce(function (a, b) {
                        return a + b
                        }, 0)
                    }
                    }
                }
                }
            }
            },
            legend: {
            show: false
            }
        }
        return donutChartOption;

    }

    var donutChart = new ApexCharts(
        document.querySelector("#donut-chart"),
        donutChartOptionCrea(window["nb_crea_type_" + annee_actuelle])
    );
    donutChart.render();

    // S'éxecute lorsqu'on change l'année du select dans Juridique
    $("#id_select_annee_juridique").change(function() {

        // On récupère le titre pour savoir dans quelle section on se situe (Radiation, Création ou Modification)
        var titre_juridique = document.getElementById("id_titre_juridique").textContent;

        // On récupère l'année selectionnée
        var annee_juridique = $(this).children("option:selected").val(); 

        if (titre_juridique == "Radiation d'entreprise") {

            // A VENIR

        } else if (titre_juridique == "Création d'entreprise") { 
        
            // On remplace le graphique par rapport à l'année sélectionnée
            $("#donut-chart").empty();

            var donutChart = new ApexCharts(
                document.querySelector("#donut-chart"),
                donutChartOptionCrea(window["nb_crea_type_" + annee_juridique])
            );

            donutChart.render();

        } else if (titre_juridique == "Modification d'entreprise") {

            $("#donut-chart").empty();

            var donutChart = new ApexCharts(
                document.querySelector("#donut-chart"),
                donutChartOptionModif(window["nb_modif_type_" + annee_juridique])
            );

            donutChart.render();

        }
      
    });

    // Stacked Bar Nagetive Chart
    // ----------------------------------
    var barNegativeChartoptions = {
        chart: {
            height: 110,
            stacked: true,
            type: 'bar',
            toolbar: { show: false },
            sparkline: {
                enabled: true,
            },
        },
        plotOptions: {
            bar: {
                columnWidth: '20%',
                endingShape: 'rounded',
            },
            distributed: true,
        },
        colors: [$primary, $warning],
        series: [{
            name: 'New Clients',
            data: [75, 150, 225, 200, 35, 50, 150, 180, 50, 150, 240, 140, 75, 35, 60, 120]
        }, {
            name: 'Retained Clients',
            data: [-100, -55, -40, -120, -70, -40, -60, -50, -70, -30, -60, -40, -50, -70, -40, -50],
        }],
        grid: {
            show: false,
        },
        legend: {
            show: false,
        },
        dataLabels: {
            enabled: false
        },
        tooltip: {
            x: { show: false }
        },
    }
  
    var barNegativeChart = new ApexCharts(
        document.querySelector("#bar-negative-chart"),
        barNegativeChartoptions
    );
  
    barNegativeChart.render();
  
    // Primary Line Chart
    // -----------------------------
    var primaryLineChartOption = {
        chart: {
            height: 40,
            // width: 180,
            type: 'line',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true,
            },
        },
        grid: {
            show: false,
            padding: {
                bottom: 5,
                top: 5,
                left: 10,
                right: 0
            }
        },
        colors: [$primary],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 3,
            curve: 'smooth'
        },
        series: [{
            data: [50, 100, 0, 60, 20, 30]
        }],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: "horizontal",
                gradientToColors: [$primary],
                opacityFrom: 0,
                opacityTo: 0.9,
                stops: [0, 30, 70, 100]
            }
        },
        xaxis: {
            show: false,
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            }
        },
        yaxis: {
            show: false
        },
    }
  
    var primaryLineChart = new ApexCharts(
        document.querySelector("#primary-line-chart"),
        primaryLineChartOption
    );
    primaryLineChart.render();
  
    // Warning Line Chart
    // -----------------------------
    var warningLineChartOption = {
        chart: {
            height: 40,
            // width: 90,
            type: 'line',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true,
            },
        },
        grid: {
            show: false,
            padding: {
                bottom: 5,
                top: 5,
                left: 10,
                right: 0
            }
        },
        colors: [$warning],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 3,
            curve: 'smooth'
        },
        series: [{
            data: [30, 60, 30, 80, 20, 70]
        }],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: "horizontal",
                gradientToColors: [$warning],
                opacityFrom: 0,
                opacityTo: 0.9,
                stops: [0, 30, 70, 100]
            }
        },
        xaxis: {
            show: false,
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            }
        },
        yaxis: {
            show: false
        },
    }
  
    var warningLineChart = new ApexCharts(
        document.querySelector("#warning-line-chart"),
        warningLineChartOption
    );
    warningLineChart.render();
  
    // Profit Primary Chart
    // --------------------------------
    var profitPrimaryOptions = {
        chart: {
            height: 40,
            width: 40,
            type: "radialBar",
            sparkline: {
                show: true
            }
        },
        grid: {
            show: false,
            padding: {
                left: -30,
                right: -30,
                top: 0,
                bottom: -70
            }
        },
        series: [50],
        colors: [$primary],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "30%"
                },
                dataLabels: {
                    showOn: "always",
                    name: {
                        show: false
                    },
                    value: {
                        show: false,
                    }
                }
            }
        },
        stroke: {
            lineCap: "round",
        }
    };
    var profitPrimaryChart = new ApexCharts(
        document.querySelector("#profit-primary-chart"),
        profitPrimaryOptions
    );
  
    profitPrimaryChart.render();
  
  
    // Profit Info Chart
    // --------------------------------
    var profitInfoOptions = {
        chart: {
            height: 40,
            width: 40,
            type: "radialBar",
            sparkline: {
                show: true
            }
        },
        grid: {
            show: false,
            padding: {
                left: -30,
                right: -30,
                top: 0,
                bottom: -70
            }
        },
        series: [70],
        colors: [$info],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: "30%"
                },
                dataLabels: {
                    showOn: "always",
                    name: {
                        show: false
                    },
                    value: {
                        show: false,
                    }
                }
            }
        },
        stroke: {
            lineCap: "round",
        }
    };
    var profitInfoChart = new ApexCharts(
        document.querySelector("#profit-info-chart"),
        profitInfoOptions
    );
  
    profitInfoChart.render();
  
    // Registration Chart
    // -------------------
    var registrationChartoptions = {
        chart: {
            type: 'bar',
            height: 60,
            width: 120,
            sparkline: { enabled: true },
            toolbar: { show: false },
        },
        states: {
            hover: {
                filter: 'none'
            }
        },
        colors: [$danger_light, $danger_light, $danger_light, $danger_light, $warning, $danger_light],
        series: [{
            name: 'Sessions',
            data: [3, 7, 5, 15, 9, 8, 12]
        }],
        grid: {
            show: false,
            padding: {
                left: 0,
                right: 0
            }
        },
  
        plotOptions: {
            bar: {
                columnWidth: '80%',
                distributed: true,
            }
        },
        tooltip: {
            x: { show: false }
        },
        xaxis: {
            type: 'numeric',
        }
    }
    var registrationChart = new ApexCharts(
        document.querySelector("#registration-chart"),
        registrationChartoptions
    );
  
    registrationChart.render();
  
    // Sales Chart
    // ---------------------
    var salesChartOptions = {
        chart: {
            height: 100,
            type: 'bar',
            stacked: true,
            toolbar: {
                show: false
            }
        },
        grid: {
            show: false,
            padding: {
                left: 0,
                right: 0,
                top: -20,
                bottom: -15
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '20%',
                endingShape: 'rounded'
            },
        },
        legend: {
            show: false
        },
        dataLabels: {
            enabled: false
        },
        colors: [$primary, $primary_light],
        series: [{
            name: '2019',
            data: [80, 40, 30, 90, 20, 50, 95]
        }, {
            name: '2018',
            data: [20, 60, 70, 10, 80, 50, 5]
        }],
        xaxis: {
            categories: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: $gray_light
                },
                offsetY: -5
            }
        },
        yaxis: {
            show: false,
            floating: true,
        },
        tooltip: {
            x: {
                show: false,
            },
        }
    }
  
    var salesChart = new ApexCharts(
        document.querySelector("#sales-chart"),
        salesChartOptions
    );
  
    salesChart.render();
  
    // Growth Radial Chart
    // --------------------
    
    function growthChartOptionsPrelev(array_pourcent, array_nb, mois) {
  
        var growthChartOptions = {
        chart: {
          height: 200,
          type: 'radialBar',
          sparkline: {
            show: true
          }
        },
        grid: {
          show: false,
        },
        plotOptions: {
          radialBar: {
            size: 100,
            startAngle: -135,
            endAngle: 135,
            offsetY: 40,
            hollow: {
              size: '60%',
            },
            track: {
              strokeWidth: '90%',
              background: '#fff'
            },
            dataLabels: {
              value: {
                offsetY: -10,
                color: '#475f7b',
                fontSize: '26px'
              },
              name: {
                fontSize: '15px',
                color: "#596778",
                offsetY: 30
              },
            }
          },
        },
        colors: [$danger],
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            type: 'horizontal',
            shadeIntensity: 0.5,
            gradientToColors: [$primary],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100]
          },
        },
        stroke: {
          dashArray: 3
        },
        series: [array_pourcent[mois]],
        labels: [array_nb[mois] + " prélèvem."],
        }
    
        return growthChartOptions
    
    }

    function growthChartOptionsBilan(pourcent, nb) {
  
      var growthChartOptions = {
      chart: {
        height: 200,
        type: 'radialBar',
        sparkline: {
          show: true
        }
      },
      grid: {
        show: false,
      },
      plotOptions: {
        radialBar: {
          size: 100,
          startAngle: -135,
          endAngle: 135,
          offsetY: 40,
          hollow: {
            size: '60%',
          },
          track: {
            strokeWidth: '90%',
            background: '#fff'
          },
          dataLabels: {
            value: {
              offsetY: -10,
              color: '#475f7b',
              fontSize: '26px'
            },
            name: {
              fontSize: '15px',
              color: "#596778",
              offsetY: 30
            },
          }
        },
      },
      colors: [$danger],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          type: 'horizontal',
          shadeIntensity: 0.5,
          gradientToColors: [$primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        },
      },
      stroke: {
        dashArray: 3
      },
      series: [pourcent],
      labels: [nb + " bilans"],
      }
  
      return growthChartOptions
  
    }
  
    document.getElementById("id_select_mois_prelevement").selectedIndex = mois_actuel;
  
    // DEBUT TAUX DE PRELEVEMENT

    var growthChart = new ApexCharts(
        document.querySelector("#growth-Chart-prelevement"),
        growthChartOptionsPrelev(window["pourcent_prelev_" + annee_actuelle], window["nb_prelev_" + annee_actuelle], mois_actuel)
    );
  
    growthChart.render();

    function changerGrowthChart() {

        var annee_prelevement = $("#id_select_annee_prelevement").children("option:selected").val();
        var mois_prelevement = $("#id_select_mois_prelevement").children("option:selected").val();
    
        $("#growth-Chart-prelevement").empty();
    
        var growthChart = new ApexCharts(
            document.querySelector("#growth-Chart-prelevement"),
            growthChartOptionsPrelev(window["pourcent_prelev_" + annee_prelevement], window["nb_prelev_" + annee_prelevement], mois_prelevement)
        );
        
        growthChart.render();

    }
  
    $("#id_select_annee_prelevement").change(function() {
        changerGrowthChart();
    });
    
    $("#id_select_mois_prelevement").change(function() {
        changerGrowthChart();
    });
  
    // FIN TAUX DE PRELEVEMENT
  
    // DEBUT BILAN ANNUEL
    var growthChart = new ApexCharts(
        document.querySelector("#growth-Chart-bilan"),
        growthChartOptionsBilan(pourcent_bilan[annee_actuelle - 1], nb_bilan[annee_actuelle - 1])
    );

    growthChart.render();
  
    $("#id_select_bilan").change(function() {
    
        var annee_bilan = $(this).children("option:selected").val();
    
        $("#growth-Chart-bilan").empty();
        var growthChart = new ApexCharts(
            document.querySelector("#growth-Chart-bilan"),
            growthChartOptionsBilan(pourcent_bilan[annee_bilan], nb_bilan[annee_bilan])
        );

      growthChart.render();
    
    });
  
    // FIN BILAN ANNUEL
  

    // Widget Todo List
    // ------------------
    // Task List Widget - for completed todo item
    $(document).on('click', '.widget-todo-item input', function() {
        $(this).closest('.widget-todo-item').toggleClass("completed");
    });
  
    // Drag the task
    dragula([document.getElementById("widget-todo-list")], {
        moves: function(el, container, handle) {
            return handle.classList.contains("cursor-move");
        }
    });
  
  });
