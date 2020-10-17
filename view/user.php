

<h1>User</h1>

<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <h1>Contact</h1>
    </div>
    <?php
     var_dump(\app\core\Auth::user());
    ?>
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <form class="form" method="post">
            <div>
                <input type="text" name="email" value="">
            </div>
            <div>
                <input type="text" name="subject">
            </div>
            <div>
                <input type="text" name="firstname" value="">
            </div>
            <div>
                <input type="text" name="lastname">
            </div>
            <div>
                <input type="text" name="password" value="">
            </div>
<!--            <div>-->
<!--                <input type="text" name="subject">-->
<!--            </div>-->
            <div>
                <input type="submit">
            </div>
        </form>



        </form>
    </div>
</div>


