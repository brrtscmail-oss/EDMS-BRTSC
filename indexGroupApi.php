<?php
    include "dropdownMenu.php";

    $arrMth = array(
        '',
        'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน',
        'กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'
    );

    $arrGrp = array(
        '',
        'สพป.บร. เขต 1',
        'สพป.บร. เขต 2',
        'สพป.บร. เขต 3',
        'สพป.บร. เขต 4',
        'สพม.32',
        'พนักงานราชการ เขต 1-4',
        'บำนาญ เขต 1',
        'บำนาญ เขต 2',
        'บำนาญ เขต 3',
        'บำนาญ เขต 4',
        'ลูกหนี้พิเศษ และ เทศบาล/อบต.',
        'สมทบ ( S10001 )',
        'สมทบ ( S10002 )',
        'สมทบ อื่นๆ'
    );

    $d = date("d");
    $m = intval(date("m"));
    $y = date("Y") + 543;

    $txtDate = $d . " " . $arrMth[$m] . " " . $y;
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ตรวจล้มละลาย - กลุ่มสมาชิก</title>

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Kanit', sans-serif;
            background:
                linear-gradient(135deg, #eef4ff 0%, #f8fbff 45%, #eefaf7 100%);
            min-height: 100vh;
            color: #1e293b;
        }

        /* ==============================
           Container
        ============================== */

        .bankrupt-container {
            width: 100%;
            max-width: 760px;
            margin: 45px auto 80px;
            padding: 0 20px;
        }


        /* ==============================
           Header
        ============================== */

        .bankrupt-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .bankrupt-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 20px;

            background: linear-gradient(135deg, #2563eb, #4f46e5);

            color: white;
            font-size: 34px;

            box-shadow:
                0 12px 25px rgba(37, 99, 235, .22);
        }

        .bankrupt-title {
            margin: 0;

            font-size: 30px;
            font-weight: 600;

            color: #172554;
            letter-spacing: .2px;
        }

        .bankrupt-subtitle {
            margin-top: 6px;

            font-size: 15px;
            font-weight: 300;

            color: #64748b;
        }


        /* ==============================
           Card
        ============================== */

        .bankrupt-card {

            background: rgba(255,255,255,.94);

            border: 1px solid rgba(226,232,240,.9);

            border-radius: 22px;

            padding: 32px;

            box-shadow:
                0 20px 40px rgba(15,23,42,.15),
                0 5px 12px rgba(15,23,42,.08);

            backdrop-filter: blur(8px);
        }


        /* ==============================
           Section
        ============================== */

        .section-title {

            display: flex;
            align-items: center;

            gap: 10px;

            margin-bottom: 12px;

            font-size: 18px;
            font-weight: 500;

            color: #334155;
        }

        .section-number {

            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #eff6ff;
            color: #2563eb;

            font-size: 15px;
            font-weight: 600;
        }


        /* ==============================
           Select
        ============================== */

        .group-select {

            width: 100%;
            height: 52px;

            padding: 0 16px;

            border: 1px solid #cbd5e1;
            border-radius: 12px;

            background: #f8fafc;

            color: #334155;

            font-family: 'Kanit', sans-serif;
            font-size: 16px;

            outline: none;

            cursor: pointer;

            transition: .2s;
        }

        .group-select:hover {
            border-color: #93c5fd;
            background: #ffffff;
        }

        .group-select:focus {

            border-color: #2563eb;

            background: #ffffff;

            box-shadow:
                0 0 0 4px rgba(37,99,235,.10);
        }


        /* ==============================
           Divider
        ============================== */

        .divider {

            height: 1px;

            background: #e2e8f0;

            margin: 28px 0;
        }


        /* ==============================
           Date Options
        ============================== */

        .date-options {

            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .date-option {

            position: relative;

            display: flex;
            align-items: center;

            padding: 14px 16px;

            border: 1px solid #e2e8f0;
            border-radius: 13px;

            background: #f8fafc;

            cursor: pointer;

            transition: all .2s ease;
        }

        .date-option:hover {

            background: #ffffff;

            border-color: #93c5fd;

            transform: translateY(-1px);
        }

        .date-option input {

            width: 18px;
            height: 18px;

            margin: 0 13px 0 0;

            accent-color: #2563eb;

            cursor: pointer;
        }

        .date-main {

            font-size: 16px;
            font-weight: 400;

            color: #334155;
        }

        .date-current {

            margin-left: 5px;

            color: #2563eb;

            font-weight: 500;
        }

        .date-old {

            color: #64748b;
        }


        /* ==============================
           Button
        ============================== */

        .button-area {

            text-align: center;

            margin-top: 30px;
        }

        .btn-check {

            width: 100%;
            max-width: 300px;

            height: 54px;

            border: none;
            border-radius: 14px;

            background: linear-gradient(
                135deg,
                #2563eb,
                #4f46e5
            );

            color: #ffffff;

            font-family: 'Kanit', sans-serif;

            font-size: 18px;
            font-weight: 500;

            cursor: pointer;

            box-shadow:
                0 10px 22px rgba(37,99,235,.22);

            transition: all .2s ease;
        }

        .btn-check:hover {

            transform: translateY(-2px);

            box-shadow:
                0 14px 28px rgba(37,99,235,.28);
        }

        .btn-check:active {

            transform: translateY(0);

            box-shadow:
                0 5px 12px rgba(37,99,235,.18);
        }


        /* ==============================
           Footer Note
        ============================== */

        .form-note {

            margin-top: 18px;

            text-align: center;

            font-size: 13px;

            font-weight: 300;

            color: #94a3b8;
        }


        /* ==============================
           Responsive
        ============================== */

        @media (max-width: 600px) {

            .bankrupt-container {
                margin-top: 25px;
                padding: 0 12px;
            }

            .bankrupt-card {
                padding: 22px 18px;
                border-radius: 18px;
            }

            .bankrupt-title {
                font-size: 24px;
            }

            .bankrupt-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }

            .date-main {
                font-size: 14px;
            }
        }

    </style>
</head>

<body>

<div class="bankrupt-container">

    <!-- Header -->
    <div class="bankrupt-header">

        <div class="bankrupt-icon">
            ⚖
        </div>

        <h1 class="bankrupt-title">
            ตรวจสอบบุคคลล้มละลาย
        </h1>

        <div class="bankrupt-subtitle">
            ตรวจสอบข้อมูลสมาชิกตามกลุ่มสังกัด
        </div>

    </div>


    <!-- Main Card -->
    <div class="bankrupt-card">

        <form
            method="POST"
            action="api/apiRepMembGroup.php"
            target="_blank"
        >

            <!-- Group -->
            <div class="section-title">
                <div class="section-number">1</div>
                เลือกกลุ่มสังกัด
            </div>


            <select
                name="recGrp"
                class="group-select"
            >

                <?php
                for ($i = 1; $i <= 14; $i++) {

                    echo "<option value='{$i}'>
                            {$arrGrp[$i]}
                          </option>";
                }
                ?>

            </select>


            <div class="divider"></div>


            <!-- Date -->
            <div class="section-title">

                <div class="section-number">
                    2
                </div>

                ข้อมูล ณ วันที่

            </div>


            <div class="date-options">

                <!-- Old Date -->
                <label class="date-option">

                    <input
                        type="radio"
                        name="dbDept"
                        value="1"
                    >

                    <span class="date-main date-old">
                        30 กันยายน 2567
                    </span>

                </label>


                <!-- Current Date -->
                <label class="date-option">

                    <input
                        type="radio"
                        name="dbDept"
                        value="2"
                        checked
                    >

                    <span class="date-main">

                        ปัจจุบัน

                        <span class="date-current">
                            ( <?= $txtDate ?> )
                        </span>

                    </span>

                </label>

            </div>


            <!-- Button -->
            <div class="button-area">

                <button
                    type="submit"
                    name="submit"
                    class="btn-check"
                >
                    ตรวจสอบข้อมูล
                </button>

            </div>


            <div class="form-note">
                ระบบจะเปิดผลการตรวจสอบในหน้าต่างใหม่
            </div>

        </form>

    </div>

</div>

</body>
</html>