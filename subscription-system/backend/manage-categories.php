<?php
$title = "Manage Categories";
$page = "manage-categories";

require './template/header-links.php';
require './template/header.php';

$query = "SELECT * FROM category";
$categories = mysqli_query($dbconnect, $query);

?>

<div class="container-fluid">
  <div class="row">
          <!-- sidebar  -->
  <?php require './template/sidebar.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Manage Categories</h2>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSignin">Add Categories</button>
                    
                </div>

                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Category Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php if (mysqli_num_rows($categories) > 0) : ?>
                                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                                  <tr>
                                    <td><?= $category['category_title'] ?></td>        
                                    <td><button class="btn btn-primary edit-category-btn" id="<?= $category['id'] ?>" data-bs-toggle="modal" data-bs-target="#modalSigninEdit">Edit</button></td>
                                    <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-category.php?id=<?= $category['id'] ?>"  class="btn btn-danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    <?php else :  ?>
                        <tr>
                            <td colspan="3" class="text-center p-2"> No Category Created</td>
                        </tr>
                    <?php endif  ?>

                        </tbody>
                    </table>
                </div>
            </main>



            <!--************** Modal Section  **************************-->
            <div class="modal" tabindex="-1" id="modalSignin">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Category</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="add-category-modal">
                          <div class="form-floating text-center">
                              <div class="error-txtmodal"></div>
                          </div>
                          <div class="form-group mb-3">
                            <label for="category">Category</label>
                            <input type="text" class="form-control p-3 mt-2" name="category" placeholder="Enter Category">
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success add-category-btn"  type="submit" >Create Category</button>
                            </div>
                          </div>
                        </form>
                    </div>
                  </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="modalSigninEdit">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="edit-category-modal">
                          <div class="form-floating text-center">
                              <div class="error-txtmodal"></div>
                          </div>
                          <div class="form-group mb-3">
                            <label for="category">Category</label>
                            <input type="hidden" class="form-control p-3 mt-2" name="id" id="prev_category_id" placeholder="Enter Category">
                            <input type="text" class="form-control p-3 mt-2" name="category" id="category" placeholder="Enter Category">
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success update-category-btn"  type="submit" >Update Category</button>
                            </div>
                          </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>


    <script src="../js/edit-category.js"></script>
    <script src="../js/add-category.js"></script>
<?php
  require './template/footer.php';
?>