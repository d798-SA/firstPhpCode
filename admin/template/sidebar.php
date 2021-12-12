<div class="sidebar-wrapper">
    <div class="logo">
        <a href="<?php echo $config['app_url'] ?>" class="simple-text">
            <?php echo $config['app_name'] ?>
        </a>
    </div>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $config['app_url'] ?>admin">
                <i class="fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>


        </li>

        <li class="nav-item ">
            <a class="nav-link" href="<?php echo $config['app_url'] ?>admin/services">
                <i class="fab fa-servicestack"></i>
                <p>services</p>
            </a>
        </li>


        <li class="nav-item ">
            <a class="nav-link" href="<?php echo $config['app_url'] ?>admin/users">
                <i class="fas fa-user-secret"></i>
                <p>users</p>
            </a>
        </li>


        <li class="nav-item ">
            <a class="nav-link" href="<?php echo $config['app_url'] ?>admin/product">
                <i class="fab fa-affiliatetheme"></i>
                <p>product</p>
            </a>
        </li>


        <li class="nav-item  active-pro">
            <a class="nav-link" href="<?php echo $config['app_url'] ?>admin/settings">
                <i class="fas fa-cogs"></i>
                <p>settings</p>
            </a>
        </li>
    </ul>
</div>