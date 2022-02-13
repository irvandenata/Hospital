<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style type="text/css">
        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

    </style>
    <style>
        .border-1 {
            border: 1px solid black;
            border-collapse: collapse;

        }

        .text {
            font-size: 10px
        }

        .padding {
            padding: 10px 10px;
        }

        table,
        th,
        td {
            font-size: 10px;

            border-collapse: collapse;
        }

    </style>
</head>

<body onload="window.print()">


    <table border="0" style="width: 95%">
        <tbody>
            <tr>
                <td colspan="2" align="center">
                    <span><img src="{{ asset('images/untan.png') }}" width="50" alt="" srcset=""><br>
                        RUMAH SAKIT <br>
                        Universitas Tanjugpura
                    </span>
                </td>
                <td colspan="8" align="center" valign="middle">
                    <span>
                        <h2 style="margin-top : 30px">RENCANA ASUHAN KEPERAWATAN</h2>
                    </span>

                </td>

            </tr>
            <tr>
                <td colspan="10">
                    <hr size="3" color="black">
                </td>
            </tr>
            <tr align="left">
                <td colspan="1" valign="top"><span style="font-size: x-small;">Diagnosis Keperawatan</span></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">:</span></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">{{ $item->getData()->diagnosa->diagnosis }} ({{ $item->getData()->diagnosa->kode }})</span></td>
                <td colspan="4"></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">Nama Ruangan</span></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">:</span></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">{{ $item->getData()->nama_ruangan }}</span></td>
            </tr>
            <tr align="left">
                <td colspan="1" valign="top"><span style="font-size: x-small;">Tanggal dan Jam</span></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">:</span></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">{{ $item->getData()->tanggal }} / {{ $item->getData()->jam }}</span></td>
                <td colspan="4"></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">PPJA</span></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">:</span></td>
                <td colspan="1" valign="top"><span style="font-size: x-small;">{{ $item->getData()->ppja }}</span></td>
            </tr>
            <tr>
                <td>
                    <div style="height: 50px"></div>
                </td>
            </tr>


            <tr>
                <td align="center" colspan="12" class="border-1 border-1 " style="background-color: #D6EEEE; padding:5px 0">
                    <span style="font-size: 15px;"><b>DIAGNOSIS KEPERAWATAN</b></span>
                </td>
            </tr>
            <tr>
                <td class="padding border-1" align="left" valign="top" v colspan="6" style="width: 40%"><span style="font-size: 12px; ">{{ $item->getData()->diagnosa->diagnosis }} ({{ $item->getData()->diagnosa->kode }}) berhubungan dengan : <br>
                        <ul>
                            @foreach($item->getData()->hasil_diagnosa->penyebab as $data)
                                <li>{{ $data->nama }}</li>
                            @endforeach
                             <li style="list-style-type: none;">Tambahan : {{ $item->getData()->tambahan_diagnosa_penyebab }}</li>
                        </ul>
                    </span></td>
                <td align="left" valign="top" colspan="6" style="width: 60%; font-size:10px" class="padding text border-1">DIBUKTIKAN DENGAN : <br><br>
                    <span style="font-size: 10px; ">Data Subjektif :</span>

                    <ul>
                        @foreach($item->getData()->hasil_diagnosa->data_subjektif as $data)
                            <li>{{ $data->nama }}</li>
                        @endforeach
                        <li style="list-style-type: none;">Tambahan : {{ $item->getData()->tambahan_diagnosa_subjektif }}</li>
                    </ul>



                    <span style="font-size: 10px; ">Data Objektif :</span>
                    <ul>
                        @foreach($item->getData()->hasil_diagnosa->data_objektif as $data)
                            <li>{{ $data->nama }}</li>
                        @endforeach
                         <li style="list-style-type: none;">Tambahan : {{ $item->getData()->tambahan_diagnosa_objektif }}</li>
                    </ul>
                </td>


            </tr>
            <tr>
                <td align="center" colspan="12" class="border-1 " style="background-color: #D6EEEE; padding:5px 0">
                    <span style="font-size: 15px;"><b>PERENCANAAN</b></span>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="12" class="border-1 " style=" padding:3px 0">
                    <span style="font-size: 10px;"><b>LUARAN DAN KRITERIA HASIL</b></span>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="padding border-1">
                    <span>Setelah dilakukan intervensi selama {{ $item->getData()->jumlah_intervensi }} x 24 jam, {{ $item->getData()->luaran->luaran }} ({{ $item->getData()->luaran->kode }}) meningkat dengan kriteria hasil:</span><br>
                    <ul>
                        @foreach($item->getData()->hasil_luaran->kriteria_hasil as $data)
                            <li>{{ $data->nama }}</li>
                        @endforeach
                    </ul>
                </td>


                @foreach($item->getData()->intervensi as $data)
            </tr>
            <tr>
                <td align="center" colspan="12" class="border-1 " style=" padding:3px 0">
                    <span style="font-size: 10px;"><b>Intervensi : {{ $data->nama }} ({{ $data->kode }})</b></span><br>

                </td>
            </tr>
            <tr>
                <td colspan="12" class="padding border-1">
                    <span style="font-size: 10px;">Pengertian : {{ $data->pengertian }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="padding border-1">
                    <span>Observasi</span><br>
                    <ul>
                        @foreach($data->hasil_observasi as $value)
                            <li>{{ $value->nama }}</li>
                        @endforeach

                    </ul>
                    <br>
                    <span>Terapeutik</span><br>
                    <ul>
                        @foreach($data->hasil_terapeutik as $value)
                            <li>{{ $value->nama }}</li>
                        @endforeach
                    </ul>
                </td>
                <td colspan="6" class="padding border-1">
                    <span>Edukasi</span><br>
                    <ul>
                        @foreach($data->hasil_edukasi as $value)
                            <li>{{ $value->nama }}</li>
                        @endforeach
                    </ul>
                    <br>
                    <span>Kolaborasi</span><br>
                    <ul>
                        @foreach($data->hasil_kolaborasi as $value)
                            <li>{{ $value->nama }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach

            <tr>
                <td align="center" valign='bottom' style="height: 200px;" colspan="6">
                    <div>
                        Pontianak,
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 20 <br>
                        Perawat Penanggung Jawab Asuhan
                        <br><br><br>
                        <br><br><br>
                        <br><br>
                        {{ $item->getData()->penanggung_jawab }}
                        <hr width="100">
                    </div>


                </td>
                <td align="center" valign='bottom' style="height: 200px" colspan="6">
                    Mengetahui ,
                    <br>Kepala Ruangan
                    <br><br><br>
                    <br><br><br>
                    <br><br><br>
                    <hr width="100">

                </td>
            </tr>

        </tbody>
    </table>

</body>

</html>
