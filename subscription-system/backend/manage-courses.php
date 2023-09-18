<?php
$title = "Manage Courses";
$page = "manage-courses";

require './template/header-links.php';
require 'template/header.php';


// get available categries 
  $query = "SELECT * FROM category ";
  $categories = mysqli_query($dbconnect, $query);

  $categ = mysqli_query($dbconnect, $query);
  
  //  Category Edit 
  $cate = mysqli_query($dbconnect, $query);



  // get available courses 
    $query = "SELECT * FROM course ORDER BY category_id ASC";
    $courses = mysqli_query($dbconnect, $query);

    $courseNo = 0;

  ?>
  
  
    <div class="container-fluid">
      <div class="row">
              <!-- sidebar  -->
      <?php require './template/sidebar.php'; ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2>Manage Courses</h2> <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">Add Course</button>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Serial No.</th>
                <th scope="col">Courses</th>
                <th scope="col">Category</th>
                <th scope="col">Fee</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($courses) > 0) : ?>
                        <?php while ($course = mysqli_fetch_assoc($courses)) : ?>
                              <tr>
                                  <td><?= ++$courseNo ?></td>
                                  <td>
                                    <?php  echo $course['course_title']; ?> 
                                  </td>
                                  <td><?php
                                  
                                  $cat_id = $course['category_id'];

                                  // get available categories 
                                  $query = "SELECT * FROM category WHERE id = $cat_id";
                                  $categories = mysqli_query($dbconnect, $query);
                                   if (mysqli_num_rows($categories) > 0){
                                    $category = mysqli_fetch_assoc($categories);
                                     echo $category['category_title'];
                                   }
                                   ?></td> 
                                   <td> <b>$ </b>
                                    <?php  echo $course['amount']; ?> 
                                  </td>       
                                  <td><button class="btn btn-primary edit-course-btn" id="<?= $course['id'] ?>" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit</button></td>
                                  <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-course.php?id=<?= $course['id'] ?>"  class="btn btn-danger">Delete</a></td>
                              </tr>
                        <?php endwhile ?>
                    <?php else :  ?>
                        <tr>
                            <td colspan="6" class="text-center p-2"> No Courses added</td>
                        </tr>
                    <?php endif  ?>
             

            </tbody>
          </table>
        </div>
      </main>


 <!--************** Modal Section  **************************-->
 <div class="modal" tabindex="-1" id="modalAdd">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="add-course-modal">
                    <div class="form-floating text-center">
                        <div class="error-txtmodal"></div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control p-3" name="course" id="course" placeholder="Enter course title">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control p-3" name="amount" id="amount" placeholder="Enter course fee">
                    </div>
                    <div class="col-lg-12 my-2">
                        <div class="form-floating">
                          <select class="form-control p-3 my-2 rounded" name="category" id="category">
                            <?php if (mysqli_num_rows($categ) > 0) : ?>
                              <option selected disabled >Category</option>
                                <?php while ($category = mysqli_fetch_assoc($categ)) : ?>
                                  <option value="<?= $category['id'] ?>"><?= $category['category_title'] ?></option>
                                  <?php endwhile ?>
                                  <?php else :  ?>
                                      <option value="">No category found</option>
                                <?php endif  ?>
                              
                          </select>   
                        </div>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary add-course-btn" type="submit">Create Course </button>
          </form>
        </div>
    </div>
  </div>
</div>

 <div class="modal" tabindex="-1" id="modalEdit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="edit-course-modal">
                <div class="form-floating text-center">
                    <div class="error-txtmodal"></div>
                </div>
                <div class="form-group mb-3">
                  <input type="hidden" class="form-control p-3 mt-2" name="prev_id" id="prev_course_id" placeholder="">
                  <input type="text" class="form-control p-3" name="courseEdit" id="course2" >
                </div>
                <div class="form-group mb-3">
                        <input type="text" class="form-control p-3" name="amountEdit" id="amount2" placeholder="Enter course fee">
                    </div>
                <div class="col-lg-12 my-2">
                    <div class="form-floating">
                      <select class="form-control p-3 my-2 rounded" name="categoryEdit" id="category2">
                      <?php if (mysqli_num_rows($cate) > 0) : ?>
                          <option  selected disabled >Category</option>
                            <?php while ($category = mysqli_fetch_assoc($cate)) : ?>
                              <option value="<?=  $category['id'] ?>"><?=  $category['category_title'] ?></option>
                              <?php endwhile ?>
                              <?php else :  ?>
                                  <option value="">No category found</option>
                            <?php endif  ?>
                      </select>   
                    </div>
                </div>
                <button class="w-100 btn btn-lg btn-primary update-course-btn" type="submit">Update Course </button>
          </form>
      </div>
    </div>
  </div>
</div>

    </div>
  </div>

  <script src="../assets/ckeditor/ckeditor.js"></script>
  <script>
    // CKEDITOR.replace('course');
    // CKEDITOR.replace('courseEdit');
  </script>
<script src="../js/edit-course.js"></script>
<script src="../js/add-course.js"></script>
<?php
  require './template/footer.php';

?>