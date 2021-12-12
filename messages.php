<?php
$title = "Message Page";

require_once 'template\header.php';
require_once 'config\database.php';

$stm3 = $conn->prepare("SELECT * , m.id AS message_id ,  s.id as services_id FROM
messages m left join services 
s on m.services_id = s.id order by m.id limit ?");
$stm3->bind_param('i', $limit);
isset($_GET['limit']) ? $limit = $_GET['limit'] : $limit = 100;
$stm3->execute();
$messages = $stm3->get_result()->fetch_all(MYSQLI_ASSOC);




if (!isset($_GET['id'])) {
?>


    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>email</th>
                    <th>Document</th>
                    <th>Services</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message) { ?>

                    <tr>
                        <td><?php echo $message['message_id'] ?></td>
                        <td><?php echo $message['contact_name'] ?></td>
                        <td><?php echo $message['contact_email'] ?></td>
                        <td><?php echo $message['file'] ?></td>
                        <td><?php echo $message['name'] ?></td>
                        <td>

                            <a href="?id=<?php echo $message['message_id'] ?>" class="btn btn-sm btn-primary">View</a>
                            <br>

                            <br>
                            <form action="" method="post" style="display: inline-block">
                                <input type="hidden" name="message_id" value="<?php echo $message['message_id'] ?>">
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>


                        </td>

                    </tr>



                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

<?php } else {
    $messageQurry = "SELECT * FROM messages m left join services s on m.services_id = s.id
                      where m.id=" . $_GET['id'] . " limit 1";

    $message = $conn->query($messageQurry)->fetch_array(MYSQLI_ASSOC);

?>

    <div class="card">


        <div class="card-title">
            <h4>the name of user is : <?php echo $message['contact_name'] ?></h4>

        </div>

        <div class="card-header">

            <h6 class="">Email the user is :<?php echo $message['contact_email'] ?></h6>

        </div>

        <div class="small">
            <?php if ($message['name']) {
                echo "the service is : ";
                echo $message['name'];
            } else {
                echo " No service";
            }; ?>
        </div>


        <div class="card-body">
            <b> the message is : <br>
                <?php echo $message['contact_message'] ?></b>
        </div>

        <?php if ($message['file']) { ?>
            <div class="card-footer">
                <a href="<?php echo $message['file'] ?>"> Downloads</a>
            </div>
        <?php } ?>
    </div>







<?php };

if (isset($_POST['message_id'])) {
    $dQ = $conn->prepare("delete from messages where id= ?");

    $dQ->bind_param('i', $_POST['message_id']);

    $dQ->execute();

    echo "<script> location.href = 'messages.php' </script>";
};


?>
<?php require_once 'template\footer.php'; ?>