# SudokuApp

The endpoints are:  
**GET** /board  
**PUT** /board/validate (or just **POST**)  

* example response from `GET /board` : **GET_board.json**
* example request json for `PUT /board/validate` completed: PUT_board.**validate.json**. And response: **completed_board.json** (change any number of the board to null, and you will receive a VALID but incomplete board/ validation response)
* example request json for `PUT /board/validate` with errors: PUT_board.**validate_errors.json**. And response: **error_response.json**

Notes: 
0. You can ignore the id field in response because the app will be stateless.
0. Add another state INVALID to be returned when there are errors present. (in total we will have three states: VALID, COMPLETED, INVALID)