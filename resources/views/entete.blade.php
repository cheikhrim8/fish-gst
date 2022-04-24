<style type="text/css">


{
  box-sizing: border-box;
}

article {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  padding: 20px;
}

h1 {
  font-size: 1.75rem;
  margin: 0 0 0.75rem 0;
}

/* Pattern styles */
.container {
  display: table;
  width: 100%;
  clear: both;
}

.left-half {
  position: absolute;
  left: 0px;
  /*width: 50%;*/
  float: left;

}

.right-half {
  position: absolute;
  right: 0px;
  width: 50%;
}

table.header-table,
table.header-table tr,
table.header-table td {
    border: 0;
}

table.header-table { table-layout: fixed; }
table.header-table td { width: 33.3333%; }

</style>


<section>
    <table class="header-table">
        <tr>
            <td>
                <p>S.N.P.M Fich</p>
                <p>Agrément : 01-068</p>
                <p>Tel :45243052 / 33347480</p>
                <p>Nouakchott - Mauritanie</p>
            </td>
            <td style="text-align: center">
                <img width="70" height="70"
                     class="logo" src="{{asset('img/logo.jpeg')}}"
                     alt="">
            </td>
            <td style="text-align: right">
                <p>DATE :  <span>{{$date}}</span></p>
                <p>N° : <span>{{$code}}</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center; padding-top: 30px">
                <h3 style="margin-top: 20px">{{$titre}}</h3>
            </td>
        </tr>
    </table>
</section>

{{--<section class="container">
  <div class="left-half">
      <h2>Société Nouvelle des produits de Mer</h2>
      <p>S.N.P.M Fich</p>
      <p>Agrément : 01-068</p>
      <p>Tel :45243052 / 33347480</p>
      <p>Nouakchott - Mauritanie</p>
		<p>{{$titre}}</p>
  </div>
  <div class="right-half">
  		<div style="margin-bottom:12%">
  			<br> <br><br><br> <br><br><br><br><br>
  			date :  {{$date}}
  			<br> <br>
  			N° {{$code}}
  		</div>
  </div>
</section>--}}
