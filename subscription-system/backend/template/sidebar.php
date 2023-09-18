<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse ">
        <div class="position-sticky pt-5 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link <?php if($page == "home"){ echo "active"; }?>" aria-current="page" href="index.php">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
            <?php if(mysqli_num_rows($curAdmins) > 0): ?>
            <li class="nav-item">
              <a class="nav-link <?php if($page == "manage-admin"){ echo "active"; }?>" href="manage-admin.php">
                <span data-feather="users" class="align-text-bottom"></span>
                Manage Admin
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($page == "manage-users"){ echo "active"; }?>" href="manage-users.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Manage Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($page == "manage-categories"){ echo "active"; }?>" href="manage-categories.php">
                <span data-feather="layers" class="align-text-bottom"></span>
                Manage Categories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($page == "manage-courses"){ echo "active"; }?>" href="manage-courses.php">
                <span data-feather="layers" class="align-text-bottom"></span>
                Manage Courses
              </a>
            </li>
            <?php else : ?>
              <li class="nav-item">
              <a class="nav-link <?php if($page == "subscribe"){ echo "active"; }?>" href="subscribe.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Subscribe
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($page == "support"){ echo "active"; }?>" href="support.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Support
              </a>
            </li>
            <?php endif ?>
            <li class="nav-item">
              <a class="nav-link <?php if($page == "edit-profile"){ echo "active"; }?>" href="edit-profile.php?current_user_id=<?= $current_user_id ?>">
                <span data-feather="file" class="align-text-bottom"></span>
                Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <div class="avatar">
                  <?php if(mysqli_num_rows($curAdmins) > 0): ?>
                  <img src="<?= ROOT_URL . 'img/admin-img/'.$curUser['avatar'] ?>" alt="avatar">
                  <?php else : ?>
                    <img src="<?= ROOT_URL . 'img/users-img/'.$curUser['avatar'] ?>" alt="avatar">
                <?php endif ?>
                </div>
              </a>
            </li>
            

          </ul>
        </div>
      </nav>