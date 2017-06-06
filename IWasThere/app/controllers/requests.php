<?php
class Requests extends Controller
{
    public $request ;

    public function __construct()
    {
        $this->request = $this->model('Request');
    }

    public function index()
    {
        $this->view('requests/index');
    }

    public function req()
    {
        session_start();
        $request =  $this->model('Request');
        $requests = $request->getRequests();

        if($_SESSION['email'] != NULL)
        {
            if(!empty($requests))
            {
                $data =  '<div class="table-responsive">
                <table class="table">
                
                <tr>
		            <th><font color="white" width="bold">ID</font></th>	
		            <th><font color="white" width="bold">Email</font></th>
                    <th><font color="white" width="bold">Restaurant Name</font></th>
                    <th><font color="white" width="bold">Restaurant Description</font></th>
                    <th><font color="white" width="bold">Date</font></th>
                    <th><font color="white" width="bold">Status</font></th>
                    <th><font color="white" width="bold">Actions</font></th>
                </tr>';
                foreach(  $requests as $request)
                {

                    $data .= '<tr>
                <td><font color="white" width="bold"> ' . $request['id'] . '</font> </td>
                <td><font color="white" width="bold">'.$request['email'].'</font></td>
                <td><font color="white" width="bold">'.$request['restaurantName'].'</font></td>
		        <td><font color="white" width="bold">'.$request['restaurantDescription'].'</font></td>
		        <td><font color="white" width="bold">'.$request['requestDate'].'</font></td>';

                 if($request['requestStatus'] == 3)
                    $data .= '<td><font color="white" width="bold"> Waiting</font> </td>';
                 if($request['requestStatus'] == 1)
                    $data .= '<td><font color="white" width="bold"> Accepted</font> </td>';
                 if($request['requestStatus'] == 0)
                    $data .= '<td><font color="white" width="bold"> Refused</font> </td>';

                    $data .= '<td>
                <font color="#f0fff0"><i onclick="ApproveRequest('.$request['id'].', true)" class="glyphicon glyphicon-ok
"></i></font>
                <font color="#f0fff0"><i onclick="ApproveRequest('.$request['id'].', false)" class="glyphicon glyphicon-remove"></i></font>
                </td>
            </tr>';
                }

            }
            else
            {
                $data = '<tr><td colspan="6">No request for today</td></tr>';

            }

            $data .= '</table>';

            echo $data;
        }

    }

    public function delete()
    {
        $request = $this->model('Request');

        if(isset($_POST['id']))
        {
            $request->deleteRequest($_POST['id']);
        }
    }

    public function create()
    {
        $request =  $this->model('Request');
        if( isset($_POST['restaurantName']) &&
            isset($_POST['description']) &&
            isset($_POST['email']))
        {


            $request->insertRequest(
                $_POST['restaurantName'],
                $_POST['description'],
                $_POST['email']
            );
        }
    }

    public function approve()
    {
        $request =  $this->model('Request');

        if( isset($_POST['id']) &&
            isset($_POST['approve']))
        {


            $request->updateRequest(
                $_POST['id'],
                $_POST['approve']
            );
        }
    }



}