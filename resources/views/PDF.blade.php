<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title></title>
  <style type="text/css">
    table {
      page-break-inside: auto;

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

    .page-break {
      page-break-after: always;
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

    .font-header {
      font-size: 12px;
      font-weight: bold;
    }

    .body {
      padding-top: 120px;
    }

    body {
      margin: 0;

    }



    /* page print margin */
  </style>
</head>

<body onload="window.print();">
  <header style="
    width: 100%;
    margin: 2px;
    position: relative;
        ">
    <div class="logo"
      style="
            width: 20%;
            text-align: center;
            position: absolute;
            top: 0;
            left: 0;
            ">
      <img src="{{ asset('images/untan.png') }}" width="40" alt="" srcset="" style="margin-bottom: 10px">
      <br>
      <div class="font-header">
        RUMAH SAKIT <br>
        Universitas Tanjugpura
      </div>
    </div>
    <div class="title"
      style="
            width: 100%;
            text-align: center;
            position: absolute;
            top: 0;
            left: 0;
            ">
      <div
        style="
            height: 78px;
            font-size:16px;font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            ">
        RENCANA ASUHAN KEPERAWATAN
      </div>
    </div>
    <div
      style="
        margin-top: 10px;
        position: absolute;
        width: 100%;
        top: 80px;
        height: 5px;
        border-top: 2px solid black;
        ">
    </div>
    <div class="box-rm"
      style="
        position: absolute;
        border: 1px solid black;
        padding: 5px;
        width: 25%;
        margin-right: 10px;
        top: 0;
        right: 0;
        display: flex;
        border-radius: 5px;
        font-size: 10px;
        align-items: center;
        height: 50px;
        ">
      <div class="grid"
        style="
        display: grid;
        height: 100%;
        padding: 10px;
        grid-template-columns: 3fr 4fr;
        font-size: 8px;

     ">
        <div>No.RM</div>
        <div>: </div>
        <div>Nama</div>
        <div>:</div>
        <div>Tgl Lahir / Umur</div>
        <div>:</div>
      </div>
    </div>
  </header>

  <div class="body">
    <table border="0" style="
    width: 100%">
      <tbody>
        <tr align="left">
          <td colspan="1" valign="top"><span style="font-size: x-small;">Nama Pasien</span></td>
          <td colspan="1" valign="top"><span style="font-size: x-small;">:</span></td>
          <td colspan="1" valign="top"><span style="font-size: x-small;">{{ $item->getData()->pasien }}</span>
          </td>

          <td colspan="6" width="5%"></td>
          <td colspan="1" valign="top"><span style="font-size: x-small;">Nama Ruangan</span></td>
          <td colspan="1" valign="top"><span style="font-size: x-small;">:</span></td>
          <td colspan="1" valign="top"><span
              style="font-size: x-small;">{{ $item->getData()->nama_ruangan }}</span>
          </td>
        </tr>
        <tr align="left">

          <td colspan="1" valign="top"><span style="font-size: x-small;">Diagnosis Keperawatan</span></td>
          <td colspan="1" valign="top"><span style="font-size: x-small;">:</span></td>
          <td colspan="1" valign="top"><span
              style="font-size: x-small;">{{ $item->getData()->diagnosa->diagnosis }}
              ({{ $item->getData()->diagnosa->kode }})</span></td>
          <td colspan="6" width="5%"></td>
          <td colspan="1" valign="top"><span style="font-size: x-small;">Tanggal dan Jam</span></td>
          <td colspan="1" valign="top"><span style="font-size: x-small;">:</span></td>
          <td colspan="1" valign="top"><span style="font-size: x-small;">{{ $item->getData()->tanggal }} /
              {{ $item->getData()->jam }}</span></td>

        </tr>
        <tr>
          <td align="center" valign="bottom" style="height: 50px" colspan="12">
            <div>
              @if ($item->getData()->status_pertama == 1)
                <h2>DIISI OLEH PPJA 24 JAM PERTAMA, HARUS DIISI DENGAN LENGKAP</h2>
              @endif
            </div>
          </td>
        </tr>


        <tr>
          <td align="center" colspan="12" class="border-1 border-1 " style="background-color: #D6EEEE; padding:5px 0">
            <span style="font-size: 15px;"><b>DIAGNOSIS KEPERAWATAN</b></span>
          </td>
        </tr>
        <tr>
          <td class="padding border-1" align="left" valign="top" v colspan="6" style="width: 40%"><span
              style="font-size: 12px; ">{{ $item->getData()->diagnosa->diagnosis }}
              ({{ $item->getData()->diagnosa->kode }}) berhubungan dengan : <br>
              <ul>
                @foreach ($item->getData()->hasil_diagnosa->penyebab as $data)
                  <li>{{ $data->nama }}</li>
                @endforeach
                <li style="list-style-type: none;">Tambahan : {{ $item->getData()->tambahan_diagnosa_penyebab }}</li>
              </ul>
            </span></td>
          <td align="left" valign="top" colspan="6" style="width: 60%; font-size:10px"
            class="padding text border-1">DIBUKTIKAN DENGAN : <br><br>
            <span style="font-size: 10px; ">Data Subjektif :</span>

            <ul>
              @foreach ($item->getData()->hasil_diagnosa->data_subjektif as $data)
                <li>{{ $data->nama }}</li>
              @endforeach
              <li style="list-style-type: none;">Tambahan : {{ $item->getData()->tambahan_diagnosa_subjektif }}</li>
            </ul>



            <span style="font-size: 10px; ">Data Objektif :</span>
            <ul>
              @foreach ($item->getData()->hasil_diagnosa->data_objektif as $data)
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
          <td align="center" colspan="12" class="border-1 " style=" padding:3px 0;
          ">
            <span style="font-size: 10px;"><b>LUARAN DAN KRITERIA HASIL</b></span>
          </td>
        </tr>
        {{-- next page --}}
        <tr class="page-break">
          <td colspan="12"style="height: 300px;" align="start" class="padding border-1">
            <span>Setelah dilakukan intervensi selama {{ $item->getData()->jumlah_intervensi }} x 24 jam,
              {{ $item->getData()->luaran->luaran }} ({{ $item->getData()->luaran->kode }})
              {{ $item->getData()->ekspektasi }} dengan kriteria hasil:</span><br>
            <ul>
              @foreach ($item->getData()->hasil_luaran->kriteria_hasil as $index => $data)
                <li>{{ $data->nama }} :
                  {{ explode('-', explode('/', $item->getData()->hasil_luaran->kriteria_sub)[$index])[1] }} </li>
              @endforeach
            </ul>
          </td>
        </tr>

        @foreach ($item->getData()->intervensi as $data)
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
                @foreach ($data->hasil_observasi as $value)
                  <li>{{ $value->nama }}</li>
                @endforeach

              </ul>
              <br>
              <span>Terapeutik</span><br>
              <ul>
                @foreach ($data->hasil_terapeutik as $value)
                  <li>{{ $value->nama }}</li>
                @endforeach
              </ul>
            </td>
            <td colspan="6" class="padding border-1">
              <span>Edukasi</span><br>
              <ul>
                @foreach ($data->hasil_edukasi as $value)
                  <li>{{ $value->nama }}</li>
                @endforeach
              </ul>
              <br>
              <span>Kolaborasi</span><br>
              <ul>
                @foreach ($data->hasil_kolaborasi as $value)
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
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              20 <br>
              Perawat Penanggung Jawab Asuhan
              <br><br><br>
              <br><br><br>
              <br><br><br>
              {{ $item->getData()->ppja }}
              <hr width="100">
            </div>


          </td>
          <td align="center" valign='bottom' style="height: 200px" colspan="6">
            Mengetahui ,
            <br>Kepala Ruangan
            <br><br><br>
            <br><br><br>
            <br><br>
            {{ $item->getData()->penanggung_jawab }}
            <hr width="100">

          </td>
        </tr>

      </tbody>
    </table>
  </div>

</body>

</html>
