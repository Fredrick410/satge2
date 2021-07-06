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

    var analyticsBarChart = new ApexCharts(
        document.querySelector("#analytics-bar-chart-compta"),
        analyticsBarChartOptions(array_actif_2021, array_passif_2021, " Nombre valide", " Passif")
    );

    analyticsBarChart.render();

    $("#id_select_portefeuille").change(function() {

        var annee_portefeuille = $("#id_select_portefeuille").children("option:selected").val();
        var array_actif = "array_actif_" + annee_portefeuille;
        var array_passif = "array_passif_" + annee_portefeuille;

        $("#analytics-bar-chart-compta").empty();

        var analyticsBarChart = new ApexCharts(
            document.querySelector("#analytics-bar-chart-compta"),
            analyticsBarChartOptions(window[array_actif], window[array_passif], " Nombre valide", " Passif")
        );

        analyticsBarChart.render();

    });

    // FIN COMPTA


    // DEBUT SOCIALE 
    var analyticsBarChart = new ApexCharts(
        document.querySelector("#analytics-bar-chart-sociale"),
        analyticsBarChartOptions(array_demande_soc_URSSAFMSA_2021, array_envoye_soc_URSSAFMSA_2021, " Nombre demandé", " Envoyé")
    );

    analyticsBarChart.render();

    $("#id_select_sociale").change(function() {

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

    });

    $("#id_select_type_sociale").change(function() {

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
    });

    // FIN SOCIALE

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
    var $nb_SARL = parseInt(document.getElementById("nb_SARL").value);
    var $nb_SAS = parseInt(document.getElementById("nb_SAS").value);
    var $nb_SASU = parseInt(document.getElementById("nb_SASU").value);
    var $nb_SCI = parseInt(document.getElementById("nb_SCI").value);
    var $nb_EIRL = parseInt(document.getElementById("nb_EIRL").value);
    var $nb_EI = parseInt(document.getElementById("nb_EI").value);
    var $nb_Micro = parseInt(document.getElementById("nb_Micro").value);
    var donutChartOption = {
        chart: {
            width: 300,
            type: 'donut',
        },
        dataLabels: {
            enabled: false
        },
        series: [$nb_SARL, $nb_SAS, $nb_SASU, $nb_SCI, $nb_EIRL, $nb_EI, $nb_Micro],
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
                            formatter: function(val) {
                                return val
                            }
                        },
                        total: {
                            show: true,
                            label: 'Entreprises',
                            color: $gray_light,
                            formatter: function(w) {
                                return w.globals.seriesTotals.reduce(function(a, b) {
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

    var donutChart = new ApexCharts(
        document.querySelector("#donut-chart"),
        donutChartOption
    );

    donutChart.render();

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

    function growthChartOptions(pourcentage, label_1) {

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
            series: [pourcentage],
            labels: [label_1],
        }

        return growthChartOptions

    }

    var annee_actuelle = (new Date()).getFullYear();
    var mois_actuel = ("0" + (new Date().getMonth() + 1)).slice(-2);

    // DEBUT TAUX DE PRELEVEMENT

    document.getElementById("id_select_mois_prelevement").selectedIndex = mois_actuel - 1;
    var id_taux_prelevement = "taux_prelevement_" + mois_actuel + "_" + annee_actuelle;
    var taux_prelevement = document.getElementById(id_taux_prelevement).value;

    var growthChart = new ApexCharts(
        document.querySelector("#growth-Chart-prelevement"),
        growthChartOptions(taux_prelevement, "Croissance")
    );

    growthChart.render();

    $("#id_select_annee_prelevement").change(function() {

        var annee_prelevement = $("#id_select_annee_prelevement").children("option:selected").val();
        var mois_prelevement = $("#id_select_mois_prelevement").children("option:selected").val();

        var id_taux_prelevement = "taux_prelevement_" + mois_prelevement + "_" + annee_prelevement;
        var taux_prelevement = document.getElementById(id_taux_prelevement).value;

        $("#growth-Chart-prelevement").empty();

        var growthChart = new ApexCharts(
            document.querySelector("#growth-Chart-prelevement"),
            growthChartOptions(taux_prelevement, "Croissance")
        );

        growthChart.render();

    });

    $("#id_select_mois_prelevement").change(function() {

        var annee_prelevement = $("#id_select_annee_prelevement").children("option:selected").val();
        var mois_prelevement = $("#id_select_mois_prelevement").children("option:selected").val();

        var id_taux_prelevement = "taux_prelevement_" + mois_prelevement + "_" + annee_prelevement;
        var taux_prelevement = document.getElementById(id_taux_prelevement).value;

        $("#growth-Chart-prelevement").empty();

        var growthChart = new ApexCharts(
            document.querySelector("#growth-Chart-prelevement"),
            growthChartOptions(taux_prelevement, "Croissance")
        );

        growthChart.render();

    });

    // FIN TAUX DE PRELEVEMENT

    // DEBUT BILAN ANNUEL

    var id_bilan_annuel = "bilan_annuel_" + (annee_actuelle - 1);
    var bilan_annuel = document.getElementById(id_bilan_annuel).value;

    var growthChart = new ApexCharts(
        document.querySelector("#growth-Chart-bilan"),
        growthChartOptions(bilan_annuel, "Croissance")
    );

    growthChart.render();

    $("#id_select_bilan").change(function() {

        var annee_bilan = $(this).children("option:selected").val();

        var id_bilan_annuel = "bilan_annuel_" + annee_bilan;
        var bilan_annuel = document.getElementById(id_bilan_annuel).value;

        $("#growth-Chart-bilan").empty();

        var growthChart = new ApexCharts(
            document.querySelector("#growth-Chart-bilan"),
            growthChartOptions(bilan_annuel, "Croissance")
        );

        growthChart.render();

    });

    // FIN BILAN ANNUEL

    // DEBUT ATTESTATION SOCIALE ENVOYE 

    document.getElementById("id_select_mois_sociale").selectedIndex = mois_actuel - 1;
    var type_sociale = $("#id_select_type_sociale").children("option:selected").val();
    var id_total_envoye = "total_envoye_" + type_sociale + "_" + mois_actuel + "_" + annee_actuelle;
    var total_envoye = document.getElementById(id_total_envoye).value;

    var growthChart = new ApexCharts(
        document.querySelector("#growth-Chart-sociale-envoye"),
        growthChartOptions(total_envoye, "Envoyé")
    );

    growthChart.render();

    $("#id_select_sociale").change(function() {

        var type_sociale = $("#id_select_type_sociale").children("option:selected").val();
        var annee_sociale = $("#id_select_sociale").children("option:selected").val();
        var mois_sociale = $("#id_select_mois_sociale").children("option:selected").val();

        var id_total_envoye = "total_envoye_" + type_sociale + "_" + mois_sociale + "_" + annee_sociale;
        var total_envoye = document.getElementById(id_total_envoye).value;
        $("#growth-Chart-sociale-envoye").empty();

        var growthChart = new ApexCharts(
            document.querySelector("#growth-Chart-sociale-envoye"),
            growthChartOptions(total_envoye, "Envoyé")
        );

        growthChart.render();

    });

    $("#id_select_mois_sociale").change(function() {

        var type_sociale = $("#id_select_type_sociale").children("option:selected").val();
        var annee_sociale = $("#id_select_sociale").children("option:selected").val();
        var mois_sociale = $("#id_select_mois_sociale").children("option:selected").val();

        var id_total_envoye = "total_envoye_" + type_sociale + "_" + mois_sociale + "_" + annee_sociale;
        var total_envoye = document.getElementById(id_total_envoye).value;
        $("#growth-Chart-sociale-envoye").empty();

        var growthChart = new ApexCharts(
            document.querySelector("#growth-Chart-sociale-envoye"),
            growthChartOptions(total_envoye, "Envoyé")
        );

        growthChart.render();

    });

    $("#id_select_type_sociale").change(function() {

        var type_sociale = $("#id_select_type_sociale").children("option:selected").val();
        var annee_sociale = $("#id_select_sociale").children("option:selected").val();
        var mois_sociale = $("#id_select_mois_sociale").children("option:selected").val();

        var id_total_envoye = "total_envoye_" + type_sociale + "_" + mois_sociale + "_" + annee_sociale;
        var total_envoye = document.getElementById(id_total_envoye).value;

        $("#growth-Chart-sociale-envoye").empty();

        var growthChart = new ApexCharts(
            document.querySelector("#growth-Chart-sociale-envoye"),
            growthChartOptions(total_envoye, "Envoyé")
        );

        growthChart.render();

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