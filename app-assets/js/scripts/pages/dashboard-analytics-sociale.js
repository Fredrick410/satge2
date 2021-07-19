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

    var annee_actuelle = (new Date()).getFullYear();
    var mois_actuel = (new Date()).getMonth();

    /**
     * Remplace le titre, le data-chart et la donut-chart lorsque qu'on change de section entre création, modification et radiation d'entreprise
     * 
     * @param {string} direction // direction de la flêche cliquée
     */
    function traiterClicFlecheSociale(direction) {


        // On récupère l'année, type et mois selectionnée
        var annee_sociale = $("#id_select_sociale").children("option:selected").val();
        var type_sociale = $("#id_select_type_sociale").children("option:selected").val();
        var mois_sociale = $("#id_select_mois_sociale").children("option:selected").val();

        var test_attestation = document.getElementById("id_titre_attestation").style.display;
        var test_bulletin = document.getElementById("id_titre_bulletin").style.display;
        var test_dsn = document.getElementById("id_titre_dsn").style.display;

        // On cherche la section dans laquelle on doit se rendre
        if (direction == "gauche") {
            if (test_attestation == 'block') {
                document.getElementById("id_titre_attestation").style.display = 'none';
                document.getElementById("id_titre_dsn").style.display = 'block';
                document.getElementById("id_titre_droite").innerText = "DSN";
            } else if (test_bulletin == 'block') {
                document.getElementById("id_titre_bulletin").style.display = 'none';
                document.getElementById("id_titre_attestation").style.display = 'block';
                if (type_sociale == "URSSAFMSA") {
                    document.getElementById("id_titre_droite").innerText = "Attestation URSSAF";
                } else if (type_sociale == "PROBTP") {
                    document.getElementById("id_titre_droite").innerText = "Attestation PRO BTP";
                } else if (type_sociale == "CIBTP") {
                    document.getElementById("id_titre_droite").innerText = "Attestation CIBTP";
                }
            } else if (test_dsn == 'block') {
                document.getElementById("id_titre_dsn").style.display = 'none';
                document.getElementById("id_titre_bulletin").style.display = 'block';
                document.getElementById("id_titre_droite").innerText = "Bulletin";
            }

        } else if (direction == "droite") {
            if (test_attestation == 'block') {
                document.getElementById("id_titre_bulletin").style.display = 'block';
                document.getElementById("id_titre_attestation").style.display = 'none';
                document.getElementById("id_titre_droite").innerText = "Bulletin";
            } else if (test_bulletin == 'block') {
                document.getElementById("id_titre_dsn").style.display = 'block';
                document.getElementById("id_titre_bulletin").style.display = 'none';
                document.getElementById("id_titre_droite").innerText = "DSN";
            } else if (test_dsn == 'block') {
                document.getElementById("id_titre_attestation").style.display = 'block';
                document.getElementById("id_titre_dsn").style.display = 'none';
                if (type_sociale == "URSSAFMSA") {
                    document.getElementById("id_titre_droite").innerText = "Attestation URSSAF";
                } else if (type_sociale == "PROBTP") {
                    document.getElementById("id_titre_droite").innerText = "Attestation PRO BTP";
                } else if (type_sociale == "CIBTP") {
                    document.getElementById("id_titre_droite").innerText = "Attestation CIBTP";
                }
            }
        }

        var test_attestation = document.getElementById("id_titre_attestation").style.display;
        var test_bulletin = document.getElementById("id_titre_bulletin").style.display;
        var test_dsn = document.getElementById("id_titre_dsn").style.display;

        if (test_attestation == 'block') { // SOCIALE
            // On remplace le graphique par rapport à l'année sélectionnée
            $("#analytics-bar-chart-sociale").empty();

            var analyticsBarChart = new ApexCharts(
                document.querySelector("#analytics-bar-chart-sociale"),
                analyticsBarChartOptions(window["array_demande_soc_" + type_sociale + "_" + annee_sociale], window["array_envoye_soc_" + type_sociale + "_" + annee_sociale], " Nombre demandé", " Envoyé")
            );

            analyticsBarChart.render();

            // Afficher le growth chart, remplace le chart par rapport à l'année et mois sélectionnée
            $("#growth-Chart-sociale-envoye").empty();

            var growthChart = new ApexCharts(
                document.querySelector("#growth-Chart-sociale-envoye"),
                growthChartOptionsSociale(window["pourcent_" + type_sociale + "_" + annee_sociale], window["nb_att_" + type_sociale + "_" + annee_sociale], mois_sociale)
            );

            growthChart.render();

        } else if (test_bulletin == 'block') {
            // On remplace le graphique par rapport à l'année sélectionnée
            $("#analytics-bar-chart-sociale").empty();
            var analyticsBarChart = new ApexCharts(
                document.querySelector("#analytics-bar-chart-sociale"),
                analyticsBarChartOptions(window["array_envoye_bulletin_" + annee_sociale], window["array_envoye_bulletin_" + annee_sociale], " Nombre envoyé", " Prélévé")
            );
            analyticsBarChart.render();

            // Afficher le growth chart, remplace le chart par rapport à l'année et mois sélectionnée
            $("#growth-Chart-sociale-envoye").empty();

            var growthChart = new ApexCharts(
                document.querySelector("#growth-Chart-sociale-envoye"),
                growthChartOptionsSociale(window["pourcent_bulletin_" + annee_sociale], window["nb_bulletin_" + annee_sociale], mois_sociale)
            );

            growthChart.render();

        } else if (test_dsn == 'block') {
            // On remplace le graphique par rapport à l'année sélectionnée
            $("#analytics-bar-chart-sociale").empty(); // SOON

            // Afficher le growth chart, remplace le chart par rapport à l'année et mois sélectionnée
            $("#growth-Chart-sociale-envoye").empty(); // SOON

        }

    }

    // Clic sur la fleche gauche sociale
    $("#id_fleche_gauche_sociale").click(function(e) {
        e.preventDefault();
        traiterClicFlecheSociale("gauche");

    });

    // Clic sur la fleche droite sociale
    $("#id_fleche_droite_sociale").click(function(e) {
        e.preventDefault();
        traiterClicFlecheSociale("droite");

    });


    // Bar Chart
    // ---------

    function analyticsBarChartOptions(array_1, array_2, legende_1, legende_2) {

        var analyticsBarChartOptions = {
            chart: {
                height: 300,
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


    // DEBUT SOCIALE 
    var analyticsBarChart = new ApexCharts(
        document.querySelector("#analytics-bar-chart-sociale"),
        analyticsBarChartOptions(array_demande_soc_URSSAFMSA_2021, array_envoye_soc_URSSAFMSA_2021, " Nombre demandé", " Envoyé")
    );

    analyticsBarChart.render();

    // S'éxecute lorsqu'on change l'année du select dans Sociale
    $("#id_select_sociale").change(function() {
        var test_attestation = document.getElementById("id_titre_attestation").style.display;
        var test_bulletin = document.getElementById("id_titre_bulletin").style.display;
        var test_dsn = document.getElementById("id_titre_dsn").style.display;

        // On récupère l'année selectionnée
        var annee_sociale = $("#id_select_sociale").children("option:selected").val();
        var type_sociale = $("#id_select_type_sociale").children("option:selected").val();
        var mois_sociale = $("#id_select_mois_sociale").children("option:selected").val();

        if (test_attestation == 'block') { // SOCIALE
            // On remplace le graphique par rapport à l'année sélectionnée
            $("#analytics-bar-chart-sociale").empty();

            var analyticsBarChart = new ApexCharts(
                document.querySelector("#analytics-bar-chart-sociale"),
                analyticsBarChartOptions(window["array_demande_soc_" + type_sociale + "_" + annee_sociale], window["array_envoye_soc_" + type_sociale + "_" + annee_sociale], " Nombre demandé", " Envoyé")
            );

            analyticsBarChart.render();

            // Afficher le growth chart, remplace le chart par rapport à l'année et mois sélectionnée
            $("#growth-Chart-sociale-envoye").empty();

            var growthChart = new ApexCharts(
                document.querySelector("#growth-Chart-sociale-envoye"),
                growthChartOptionsSociale(window["pourcent_" + type_sociale + "_" + annee_sociale], window["nb_att_" + type_sociale + "_" + annee_sociale], mois_sociale)
            );

            growthChart.render();


        } else if (test_bulletin == 'block') {

            // On remplace le graphique par rapport à l'année sélectionnée
            $("#analytics-bar-chart-sociale").empty();
            var analyticsBarChart = new ApexCharts(
                document.querySelector("#analytics-bar-chart-sociale"),
                analyticsBarChartOptions(window["array_envoye_bulletin_" + annee_sociale], window["array_envoye_bulletin_" + annee_sociale], " Nombre envoyé", " Prélévé")
            );
            analyticsBarChart.render();

            // Afficher le growth chart, remplace le chart par rapport à l'année et mois sélectionnée
            $("#growth-Chart-sociale-envoye").empty();

            var growthChart = new ApexCharts(
                document.querySelector("#growth-Chart-sociale-envoye"),
                growthChartOptionsSociale(window["pourcent_bulletin_" + annee_sociale], window["nb_bulletin_" + annee_sociale], mois_sociale)
            );

            growthChart.render();

        } else if (test_dsn == 'block') {
            // On remplace le graphique par rapport à l'année sélectionnée
            $("#analytics-bar-chart-sociale").empty(); // SOON

            // Afficher le growth chart, remplace le chart par rapport à l'année et mois sélectionnée
            $("#growth-Chart-sociale-envoye").empty();
            // SOON 

        }

    });

    $("#id_select_type_sociale").change(function() {

        // Afficher le bar chart
        var type_sociale = $("#id_select_type_sociale").children("option:selected").val();
        var annee_sociale = $("#id_select_sociale").children("option:selected").val();
        var array_demande_soc = "array_demande_soc_" + type_sociale + "_" + annee_sociale;
        var array_envoye_soc = "array_envoye_soc_" + type_sociale + "_" + annee_sociale;

        $("#analytics-bar-chart-sociale").empty();

        var analyticsBarChart = new ApexCharts(
            document.querySelector("#analytics-bar-chart-sociale"),
            analyticsBarChartOptions(window[array_demande_soc], window[array_envoye_soc], " Nombre demandé", " Envoyé")
        );

        analyticsBarChart.render();

        changerGrowthChartSociale();

        // Changer le titre growth chart par rapport au type d'attestation sélectionnée 
        if (type_sociale == "URSSAFMSA") {
            document.getElementById("id_titre_droite").innerText = "Attestation URSSAF";
            document.getElementById("id_count_attestation").innerText = count_URSSAF[$annee_sociale];
        } else if (type_sociale == "PROBTP") {
            document.getElementById("id_titre_droite").innerText = "Attestation PRO BTP";
            document.getElementById("id_count_attestation").innerText = count_PROBTP[$annee_sociale];
        } else if (type_sociale == "CIBTP") {
            document.getElementById("id_titre_droite").innerText = "Attestation CIBTP";
            document.getElementById("id_count_attestation").innerText = count_CIBTP[$annee_sociale];
        }


    });

    // FIN SOCIALE


    // Growth Radial Chart
    // --------------------

    function growthChartOptionsSociale(array_pourcent, array_nb, mois) {

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
            labels: [array_nb[mois] + " Envoyé"],
        }

        return growthChartOptions

    }

    document.getElementById("id_select_mois_sociale").selectedIndex = mois_actuel;

    // DEBUT ATTESTATION SOCIALE ENVOYE 

    var growthChart = new ApexCharts(
        document.querySelector("#growth-Chart-sociale-envoye"),
        growthChartOptionsSociale(window["pourcent_URSSAFMSA_" + annee_actuelle], window["nb_att_URSSAFMSA_" + annee_actuelle], mois_actuel)
    );

    growthChart.render();

    // Pour changer le type d'attestation sociale 
    function changerGrowthChartSociale() {
        var annee_sociale = $("#id_select_sociale").children("option:selected").val();
        var type_sociale = $("#id_select_type_sociale").children("option:selected").val();
        var mois_sociale = $("#id_select_mois_sociale").children("option:selected").val();

        $("#growth-Chart-sociale-envoye").empty();

        var growthChart = new ApexCharts(
            document.querySelector("#growth-Chart-sociale-envoye"),
            growthChartOptionsSociale(window["pourcent_" + type_sociale + "_" + annee_sociale], window["nb_att_" + type_sociale + "_" + annee_sociale], mois_sociale)
        );

        growthChart.render();

    }

    // Choisi par mois pour growth chart sociale
    $("#id_select_mois_sociale").change(function() {

        var test_attestation = document.getElementById("id_titre_attestation").style.display;
        var test_bulletin = document.getElementById("id_titre_bulletin").style.display;
        var test_dsn = document.getElementById("id_titre_dsn").style.display;

        // On récupère l'année et aussi le mois selectionnée
        var annee_sociale = $("#id_select_sociale").children("option:selected").val();
        var type_sociale = $("#id_select_type_sociale").children("option:selected").val();
        var mois_sociale = $("#id_select_mois_sociale").children("option:selected").val();

        if (test_attestation == 'block') {
            // Afficher le growth chart, remplace le chart par rapport à l'année et mois sélectionnée
            $("#growth-Chart-sociale-envoye").empty();

            var growthChart = new ApexCharts(
                document.querySelector("#growth-Chart-sociale-envoye"),
                growthChartOptionsSociale(window["pourcent_" + type_sociale + "_" + annee_sociale], window["nb_att_" + type_sociale + "_" + annee_sociale], mois_sociale)
            );

            growthChart.render();

        } else if (test_bulletin == 'block') {

            // Afficher le growth chart, remplace le chart par rapport à l'année et mois sélectionnée
            $("#growth-Chart-sociale-envoye").empty();

            var growthChart = new ApexCharts(
                document.querySelector("#growth-Chart-sociale-envoye"),
                growthChartOptionsSociale(window["pourcent_bulletin_" + annee_sociale], window["nb_bulletin_" + annee_sociale], mois_sociale)
            );

            growthChart.render();

        } else if (test_dsn == 'block') {

            // Afficher le growth chart, remplace le chart par rapport à l'année et mois sélectionnée
            $("#growth-Chart-sociale-envoye").empty();
            // SOON

        }

    });


    // FIN ATTESTATION SOCIALE ENVOYE



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