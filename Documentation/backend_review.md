# Backend Code Review
# Brief Checklist
Am I able to understand the code easily?
```bash
Yes
```
Is the code written following the coding standards/guidelines?
```bash
Yes
```
Is the same code duplicated more than twice?
```bash
No
```
Can I unit test / debug the code easily to find the root cause?
```bash
Yes. Run PHPUnit on the CLI.
```
Are any functions or classes too big? If yes, is the function or class having too many responsibilities?
```bash
No
```
# API Endpoint Naming Convention
Nouns are used for endpoints paths

Singular nouns are used for interacting with singular api resources:
```bash 
localhost/api/user/{id}	
```
Plural nouns are used for interacting with multiple api resources:
```bash 
localhost/api/users
```

# API Response Convention:
| Response Fields |                         Description                         |
|:---------------:|:-----------------------------------------------------------:|
|      Status     | 200 (Ok) or 422 (Unprocessable Entity) or 400 (Bad Request) |
|     Message     |          Additional information about the response          |
|       Data      |               Json data is under the data key               |

| Response Fields |                                      Description                                      |
|:---------------:|:-------------------------------------------------------------------------------------:|
|       200       |                           Request was processed succesfully.                          |
|       400       | Request could not process, but input was valid. A common cause could be id not found. |
|       422       |                      Request input data is invalid or malformed.                      |

## API Authentication
Api authentication is handled via the token driver module in laravel. This acts as a token based authentication guard. We went
with the built in approach as the api is currently being used internally only. Other alternates
going forward could be jwt or passport.

Request header payloads need to declare an api token in order to access most of the endpoints. This is done
through Bearer authentication.

Refresh tokens are also used to top up the access tokens as they are expirable by default with a limitied lifetime.
The access tokens can be topped up using the refresh route.

### Bearer Authentication
HTTP requests to protected routes will require the Authorization field set in the HTTP header with a key value of Bearer + ' ' + token.

Format:

Authorization: Bearer Token
Example:

```bash
Authorization: Bearer 1shtRTbPCVs2xe7cviyaIAGWClT57y9YwjyVSFerKgXeFDh0LnvdpyM6CUvb
```

# API URI Versioning:
Global uri versioning across all endpoints except for the login and register paths to prevent data breaches and potential
security issues. The intended purpose of the versioning is allow for easier tranistions between major/minor versions of api
for clients. 

Current client major version is 1.0.

# API Design Patterns
Repository and service pattern are used across all api controllers. This allows us to decouple any buisness logic from higher level modules(like the controller) for api requests and delegate the responsibilities down to lower modules. This also allows us to utilize the single responsibility principle across multiple modules.

Sample Controller logic:
```bash
class LabController extends Controller
{
    protected $lab_service;

    public function __construct(RestServiceContract $service)
    {
        $this->lab_service = $service;
    }

    public function get($id)
    {
        $res = $this->lab_service->get($id);
        return response($res['response'], $res['status']);
    }

    public function get_all()
    {
        $res = $this->lab_service->get_all();
        return response($res['response'], $res['status']);
    }

    public function create(CreateRequest $request)
    {
        $res = $this->lab_service->create($request);
        return response($res['response'], $res['status']);
    }

    public function delete($id)
    {
        $res = $this->lab_service->delete($id);
        return response($res['response'], $res['status']);
    }
}
```

Exception handling is done through try and catch clauses for any throwing code calls. The errors will propogate back
up to controller module and will be returned to the user:
```bash
class IssueService implements RestServiceContract
{
    protected $user_model, $issue_model;

    public function __construct(User $user, Issue $issue)
    {
        $this->user_model = new ModelRepository($user);
        $this->issue_model = new ModelRepository($issue);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->issue_model->getById($id);
            $assign_id =$result['data']['assigned_to'];            
            $user_assigned = DB::table('users')->where('id',$assign_id)->first();
            $user_name = $user_assigned->first_name . ' '. $user_assigned->last_name;
            $result['data']['user_name'] =$user_name;
            $users = DB::table('users')->select('id','first_name','last_name')->get();
            $result['data']['users'] =$users;

        } catch (Exception $ex) {
            $result['message'] = ' Could not find issue record.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Issue retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }
    // ...
```   

# API Request Validation
Input requests are validated by extending from the FormRequest class in Laravel. This allows us to pre-evaluate code before entering any logic in the api controllers.

```bash
class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'id' => array('required','int'),
            'title' => array('required', 'regex:/^[\s\w!-@#$^_:,.]*$/', 'max:250'),
            'room' => array('required', 'string'),
            'assigned_to' => array('required', 'int'),
            'severity' => array('required', 'string'),
            'description' => array('required', 'regex:/^[\s\w!-@#$^_:,.]*$/', 'max:250'),
            'due_date' =>array('required' ,'date'),
            
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'status' => '422 (Unprocessable Entity)',
                'message' => $validator->errors(),
                'data' => ''
            ],
            422)
        );
    }
}
```

# Middleware 

## Route Protection
Custom middleware is used for route-based authorization for specific routes:
```bash
Route::get('/users', 'Api\Auth\LoginController@get_all')->middleware(['admin_only']);
```
