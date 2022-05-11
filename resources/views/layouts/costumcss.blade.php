<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
    }

    .hozamgomb {
        background-repeat: no-repeat;
        background-size: 98px 84px;
        width: 100px;
        height: 86px;
        text-align: center;
        color: red;
        text-shadow: 1px 1px #060503;
        font-weight: bold;
        font-size:20px;
        font-family: 'Palatino, URW Palladio L, serif'
    }

    .dashboardgomb {
        background-repeat: no-repeat;
        background-size: 168px 84px;
        width: 170px;
        height: 86px;
        text-align: center;
        color: red;
        text-shadow: 1px 1px #060503;
        font-weight: bold;
        font-size:25px;
        font-family: 'Palatino, URW Palladio L, serif'
    }

    .inputWrapper label{
        display:block;
    }

    div.dataTables {
        width: 100% !important;
    }

    div.dataTables_wrapper  div.dataTables_filter {
        width: 100% !important;
        float: none;
        text-align: right;
        margin-top: -30px;
    }

    div.dataTables_paginate {
        width: 100%;
        float: none;
        text-align: right;
    }

    .dataTables_filter {
        float: left !important;
    }
    
    .table {
        table-layout: fixed;
    }


    .table thead th {
        background-image: none !important;
        background-color: lightgrey !important;
        color: black !important;
        font-family: Palatino, URW Palladio L, serif !important;
        font-weight: bold !important;
        font-size: 14px !important;
        width: 100% !important;
    }

    .table tfoot th {
        background-image: none !important;
        background-color: lightgrey !important;
        color: black !important;
        font-family: Palatino, URW Palladio L, serif !important;
        font-weight: bold !important;
        font-size: 14px !important;
        width: 100% !important;
    }

    .table tbody tr td {
        background-image: none !important;
        color: black !important;
        font-family: Palatino, URW Palladio L, serif !important;
        font-size: 14px !important;
        font-weight: bold !important;
    }

    .table.dataTable tbody tr.selected {
        color: black !important;
        background-color: gray !important;
        font-family: Palatino, URW Palladio L, serif !important;
        font-size: 14px !important;
        font-weight: bold !important;
    }


    .table.dataTable tbody th, .table.dataTable tbody td, .table.dataTable tbody tf {
        padding: 2px 6px; /* e.g. change 8x to 4px here */
        width: 100% !important;
        white-space: break-spaces;
    }

    .m-t-0 {
        text-align: center;
    }

    .content-dashboard {
        background: url('http://priestago.hu/tarca/public/img/brand/bolt.png') center center;
        background-repeat: no-repeat;
        background-size: cover;
        min-height: 800px;
    }

    .panel-footer{
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 25px;
        border-bottom-left-radius: 25px;
        border-top: 2px solid lightgray;
        padding: 10px;
        background-color: white;
        font-family: Palatino, URW Palladio L, serif !important;
        font-size: 15px !important;
        font-weight: bold !important;
    }

    .widget-user-header{
        height: 105px;
    }

    #header1 {
        background: url('public/img/theme/MentesHetes_106.png') center center;
        background-repeat: no-repeat;
        background-size: 360px 105px;
    }


    #header2 {
        background: url('public/img/product/szendvics-pĂ©kĂˇru/zsemle.jpg') center center;
        background-repeat: no-repeat;
        background-size: 400px 105px;
    }

    #header3 {
        background: url('public/img/mh/pekaru.jpg') center center;
        background-repeat: no-repeat;
        background-size: 400px 105px;
    }

    .imgcenter {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }

    .image__file-upload {
        padding: 10px;
        background: #20a8d8;
        display: table;
        color: white;
        border-radius: 0.25rem;
        border-color: #20a8d8;
    }

    .image__file-upload .d-none {
        display: none;
    }

    .image__file-upload:hover {
        cursor: pointer;
        background-color: #1985ac;
        border-color: #187da0;
    }

    .mylabel {
        margin-top: 7px;
        text-align: right;
    }

    .mylabel3 {
        margin-top: 3px;
    }

    .mylabel33 {
        margin-top: 3px;
        width: 33%;
        text-align: right;
    }

    .mylabel25 {
        margin-top: 3px;
        width: 25%;
        text-align: right;
    }

    .mylabelright {
        margin-top: 3px;
        text-align: right;
    }

    .mylabelright7 {
        margin-top: 7px;
        text-align: right;
    }

    .table.dataTable tr.group, tr.group:hover {
        background-color: #ddd !important;
    }

    .myCheckbox {
        text-align : center;
        border: 1px solid red; /* for illustration only */
    }

    .honaplezart {
        background-color: lightgray !important;
    }

    .alapbg {
        background-color: white !important;
    }

    .hetvege {
        background-color: lightgray;
    }

    .elteres {
        background-color: yellow;
    }

    .oldalcim {
        font-weight: 900;
        font-size: 30px !important;
    }

    .alapgomb {
        border: 2px solid gray;
        box-shadow: 0px 8px 15px rgba(0,0,0,0.1);
        font-size: 15px;
        margin-left: 20px;
        margin-bottom: 2px;
    }

    .szuresgomb {
        border: 2px solid gray;
        box-shadow: 0px 8px 15px rgba(0,0,0,0.1);
        font-size: 15px;
        margin-left: 20px;
        margin-top: 20px;
    }

    .penztarkep {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 105px;
        height: 105px;
        margin-top: -30px;
    }

    .hide-col {
        overflow: hidden;
        width: 0!important;
        max-width: 0!important;
        padding: 0!important;
        border-width: 0!important;
        font-size: 0!important;
        visibility: hidden;
    }

    .ujtetelgomb {
        border: 2px solid gray;
        box-shadow: 0px 8px 15px rgba(0,0,0,0.1);
        font-size: 15px;
        text-align: right;
    }

    .ujtetelcol {
        text-align: right;
    }

    .vevoirendelesgomb {
        border: 2px solid gray;
        box-shadow: 0px 8px 15px rgba(0,0,0,0.1);
        font-size: 15px;
        margin-left: 5px;
    }



</style>
