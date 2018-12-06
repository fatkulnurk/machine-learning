<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NaiveBayes </title>
    <link rel="stylesheet" href="./asset/bulma-0.7.1/css/bulma.min.css" media="all">
</head>
<body>
<div class="hero is-link is-bold is-is-medium fullwidth">
    <div class="hero-body">
        <div class="container has-text-centered">
            <p></p>
            <br>
            <h1 class="title">NaiveBayes </h1>
            <h2 class="subtitle">~~ Fatkul Nur Koirudin / 2110161019 ~~</h2>
        </div>
    </div>
</div>
<div class="section">
    <div class="columns">
        <div class="column box is-4 is-offset-4">

            <form action="result.php" method="POST">
                <div class="field">
                    <label class="label">Cuaca</label>
                    <div class="control">
                        <div class="select is-fullwidth is-info">
                            <select name="cuaca">
                                <option value="">Pilih Data </option>
                                <option value="cerah">Cerah</option>
                                <option value="hujan">Hujan</option>
                            </select>
                        </div>
                        <!--                        <input class="input is-info is-fullwidth" type="text" name="cuaca" placeholder="masukan angka k" required>-->
                    </div>
                </div>
                <div class="field">
                    <label class="label">Temperatur</label>
                    <div class="control">
                        <div class="select is-fullwidth is-info">
                            <select name="temperatur">
                                <option value="">Pilih Data </option>
                                <option value="normal">Normal</option>
                                <option value="tinggi">Tinggi</option>
                            </select>
                        </div>
                        <!--                        <input class="input" type="text" placeholder="Temperatur" name="temperatur">-->
                    </div>
                </div>
                <div class="field">
                    <label class="label">Kecepatan Angin</label>
                    <div class="control">
                        <div class="select is-fullwidth is-info">
                            <select name="angen">
                                <option value="">Pilih Data </option>
                                <option value="pelan">Pelan</option>
                                <option value="kencang">Kencang</option>
                            </select>
                        </div>
                        <!--                        <input class="input" type="text" placeholder="Kecepatan Angin" name="kecepatan">-->
                    </div>
                </div>
                <p class="is-center">
                    <input class="button is-info is-rounded" type="submit" value="Submit">
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--	<title></title>-->
<!--</head>-->
<!--<body>-->
<!--	<form method="post" action="proses.php">-->
<!--		<input type="text" name="cuaca" placeholder="cuaca">-->
<!--		<input type="text" name="temperatur" placeholder="temperatur">-->
<!--		<input type="text" name="angen" placeholder="angen" value="">-->
<!--		<input type="submit" name="ok" value="Submit">-->
<!--	</form>-->
<!--</body>-->
<!--</html>-->