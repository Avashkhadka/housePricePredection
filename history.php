<?php
include 'connect.php';
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
        <a href="HousePrediction.php"
            class="text-gray-600 hover:text-[#5C56FF] transition-colors duration-200">Predict</a>
        <a href="#" class="hover:text-[#5C56FF] text-[#5C56FF] transition-colors duration-200">History</a>
    </div>

    <div class="container max-w-7xl mx-auto my-8">
        <h1 class="text-4xl font-bold">History</h1>
        <p class="text-gray-600 text-lg mt-4">History of house Predictions</p>
        <div class="group rounded-xl bg-white mt-6 relative">
            <!-- <div class="absolute w-full h-full bg-[#5C56FF] top-0 rounded-xl -z-10 -left-1"></div> -->

            <table class="w-full rounded-lg">
                <tr class="bg-[#f9fafb] text-center textlg font-medium text-black/70 uppercase -tracking-tighter">
                    <td class="p-4">ID</td>
                    <td class="p-4">Location</td>
                    <td class="p-4">Total Sqft</td>
                    <td class="p-4">No of Bedrooms</td>
                    <td class="p-4">No of Bathrooms</td>
                    <td class="p-4">No of Balconies</td>
                    <td class="p-4">Pridicted Price</td>
                    <td class="p-4">Action</td>
                </tr>
                <?php
                function Delete($id)
                {
                    global $conn;
                    $sql = "DELETE from predictionhistory where id = $id ";
                    $res = mysqli_query($conn, $sql);


                }
                if (isset($_POST['deletebtn'])) {
                    $id = $_POST['inp'];
                    Delete($id);
                    header("Location:" . $_SERVER['PHP_SELF']);

                }

                $sql = "SELECT * from predictionhistory";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr class='text-center'>
                        <td><h2 class='text-[#6366f1] py-1 font-medium px-2 m-3 bg-[#f1f5f9] rounded-lg'>" . $row['id'] . "</h2></td>
                        <td>" . $row['location'] . "</td>
                        <td>" . $row['totalSquareft'] . "</td>
                        <td>" . $row['bedroom'] . "</td>
                        <td>" . $row['balconi'] . "</td>
                        <td>" . $row['bathroom'] . "</td>
                        <td>" . $row['price'] . "</td>
                        <td>
                        <form method='POST'>
                        <input hidden name='inp' value=" . $row['id'] . ">
                        <button class='p-2  bg-[#f1f5f9] rounded-full px-4 py-2 text-[#6366f1] cursor-pointer hover:bg-[#595cf0] hover:text-white transition-colors duration-300' name='deletebtn'>Delete</button></td>
                        </form>
                    </tr>";

                    }


                } else {
                    echo "<tr><td class='text-center p-5'>No history</tr></tr>";
                }
                ?>


            </table>


        </div>
    </div>
</body>

</html>