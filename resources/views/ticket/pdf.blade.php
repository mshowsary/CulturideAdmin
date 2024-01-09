<!DOCTYPE html>
<html>

<head>
    <title>{{ $data['id'] }}</title>

    <style type="text/css">
    body {
        background: #fff;
    }

    .w-20 {
        width: 20%;
    }

    .w-25 {
        width: 25%;
    }

    .w-30 {
        width: 30%;
    }

    .w-40 {
        width: 40%;
    }

    .w-50 {
        width: 50%;
    }

    .w-60 {
        width: 60%;
    }

    .align-right {
        text-align: right;
    }

    .th-center {
        text-align: center;
    }

    .table td,
    .table th {
        padding: 0.3rem 0.1rem;
    }
    .header_title {
        margin: 20px 0 10px 0;
    }

    .header_title h2 {
        font-size: 20px;
    }


    .header_top {
        font-size: 24px;
        color: #000;
        margin-left:20px;
    }

    .header_bottom {
        font-size: 14px;
        color: #3dbeed;
    }
    </style>
</head>

<body>
    <div class="content">
        <div style="width:30%; float:left">
            <img src="{{ public_path('/img/logo.png') }}" width="100%">
        </div>
        <div class="header_title" style="width:65%; float:right">
            <span class="header_top">PLATEFORM ÉVÉNEMENTIELLE</span>
            <span class="header_top">Billet <b>{{ $data['id']}}</b></span><br>                      
        </div>        
        <div style="margin-top:120px; width:100%;">
            <hr />
            <table class="table table-striped table-bordered" style="width:100%;"> 
                <tr>
                    <td class="w-30 th-left">
                        <img src="data:image/png;base64, {!! $data['qrTicket'] !!}">
                        <br>Billet QR
                    </td>
                    <td class="w-50 th-center">
                        <table>
                            <tr>
                                <td colspan="2">
                                    <span class="name">{{ $data['event'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span class="name">{{ $data['artist']['name'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="name">{{ $data['zone'] }}</span>
                                </td>
                                <td>
                                    <span class="name">{{ $data['seat'] }} Siège(s)</span>
                                </td>                                                     

                            </tr>
                            <tr>
                                <td>
                                    <span class="name">{{ $data['date'] }}</span>
                                </td>
                                <td>
                                    <span class="name">{{ $data['period'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span class="name">{{ $data['city'] }}</span>
                                </td>                                                                                                                               
                            </tr>
                        </table>
                    </td>  
                    <td class="w-20 th-right">
                        @if(isset($data['carpooling']['qrCarpooling']))
                        <img src="data:image/png;base64, {!! $data['carpooling']['qrCarpooling'] !!}">
                        <br>Covoiturage QR                        
                        @endif
                    </td>                                                        
                </tr>
            </table>        
            <hr />
            @if(isset($data['carpooling']))
            <div style="margin-top:20px; width:100%;">
                <span>{{$data['time']}}</span><br>
                <span>Depart covoiturage de  : {{$data['carpooling']['city']}} - {{$data['carpooling']['meeting_point']}}</span><br>
                <br>
                <span>pour vérifier l'emplacement du covoiturage, rendez-vous sur https://culturide.fr/carpooling-locations</span>                
            </div>      
            @endif            
        </div>   
    </div>
</body>
</html>