<?php


include 'connect.php';




$jsonfile = file_get_contents('location.json');
$location = json_decode($jsonfile, true);

$status = false;
$pythonLoc = 'C:/Users/ADMIN/AppData/Local/Programs/Python/Python314/python.exe';

$script = 'C:/xampp/htdocs/avashXampp/housePricePredection/predict.py';



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>House Prediction System</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- For font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Sofia&display=swap"
        rel="stylesheet" />

    <style>
        .font-inter {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body class="bg-[#F3F4F6] py-2 font-inter px-[6%] xl:px-0">
    <div class="bg-white h-16 w-[99%] mx-auto shadow-md flex items-center justify-center text-lg gap-3">
        <a href="#" class="hover:text-[#5C56FF] text-[#5C56FF] transition-colors duration-200">Predict</a>
        <a href="history.php" class="text-gray-600 hover:text-[#5C56FF] transition-colors duration-200">History</a>
    </div>
    <div class="container max-w-7xl mx-auto my-8">
        <h1 class="text-4xl font-bold">House Price Prediction</h1>
        <p class="text-gray-600 text-lg mt-4">Add Your House Requirements</p>
        <div
            class="group rounded-xl py-6 px-4 bg-white mt-6 relative transition-transform duration-300 hover:-translate-y-2 border-l-4 border-l-[#5C56FF]">
            <!-- <div class="absolute w-full h-full bg-[#5C56FF] top-0 rounded-xl -z-10 -left-1"></div> -->
            <form action="" method="POST">
                <h1 class="text-xl font-semibold mb-8">Predict Price</h1>
                <div class="w-full flex flex-col xl:flex-row justify-between">
                    <div>
                        <h3 class="text-lg font-medium mb-2">Choose the location</h3>
                        <!-- <input
                                type="number"
                                min="0"
                                required
                                placeholder="Choose the location"
                                class="w-full mb-4 inset-0 focus:outline-2 border border-gray-200 rounded-lg p-2 bg-[#F9FAFB] focus: outline-blue-500"
                            /> -->
                        <select name="location" id="" required
                            class="w-full mb-4 inset-0 focus:outline-2 border border-gray-200 rounded-lg p-2 bg-[#F9FAFB] focus: outline-blue-500">
                            <option value="">Choose the location</option>
                            <?php
                            foreach ($location as $loc) {
                                echo "<option value='$loc'>$loc</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium mb-2">Enter Total Sqft</h3>
                        <input type="number" min="500" required name="tsqft" placeholder="Enter Total Sqft"
                            class="w-full mb-4 inset-0 focus:outline-2 border border-gray-200 rounded-lg p-2 bg-[#F9FAFB] focus: outline-blue-500" />
                    </div>
                    <div>
                        <h3 class="text-lg font-medium mb-2">Enter No of Bedrooms</h3>
                        <input type="number" min="0" required name="bedroom" placeholder="Enter No of Bedrooms"
                            class="w-full mb-4 inset-0 focus:outline-2 border border-gray-200 rounded-lg p-2 bg-[#F9FAFB] focus: outline-blue-500" />
                    </div>
                    <div>
                        <h3 class="text-lg font-medium mb-2">Enter No of Bathrooms</h3>
                        <input type="number" min="0" required name="bathroom" placeholder="Enter No of Bathrooms"
                            class="w-full mb-4 inset-0 focus:outline-2 border border-gray-200 rounded-lg p-2 bg-[#F9FAFB] focus: outline-blue-500" />
                    </div>
                    <div>
                        <h3 class="text-lg font-medium mb-2">Enter No of Balconies</h3>
                        <input type="number" min="0" required name="balconi" placeholder="Enter No of Balconies"
                            class="w-full mb-4 inset-0 focus:outline-2 border border-gray-200 rounded-lg p-2 bg-[#F9FAFB] focus: outline-blue-500" />
                    </div>
                </div>
                <button
                    class="w-full p-2 bg-[#5A58EC] text-white rounded-lg mt-8 text-lg hover:bg-[#5D57FF] transition-all duration-300 cursor-pointer hover:-translate-y-1"
                    name="predict">Predict Price</button>
            </form>
        </div>
        <div
            class="group rounded-xl py-6 px-4 text-center bg-white mt-6 relative transition-transform duration-300 hover:-translate-y-2 border-l-4 border-l-[#5C56FF]">
            <?php
            if (isset($_POST['predict'])) {
                $loca = $_POST['location'];
                $tsqft = $_POST['tsqft'];
                $bathroom = $_POST['bathroom'];
                $balconies = $_POST['balconi'];
                $bedroom = $_POST['bedroom'];
                $command = "\"$pythonLoc\" \"$script\" \"$loca\" $tsqft $bathroom $balconies $bedroom";
                $output = shell_exec($command);
                $outputr = intval((floor($output) * 100000));
                $sql = 'INSERT into predictionhistory (location, totalSquareft, bedroom, balconi, bathroom, price)  values (?,?,?,?,?,?)';
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "siiiii", $loca, $tsqft, $bedroom, $balconies, $bathroom, $outputr);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                echo "Predicted price of Home is: Rs " . htmlspecialchars($outputr);




            }

            ?>
        </div>
    </div>
</body>

</html>