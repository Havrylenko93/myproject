###
@apiVersion 1.0.0
@api {post} /deleteUser  deleteUser
@apiName deleteUser
@apiDescription api deleting user by token
@apiGroup facebook

@apiParam {String} token fb token

@apiSuccess {String} msg user was deleted
@apiParamExample {json} Request-Example:
{
	"token" : "EAACEdEose0cBAEHLJ2ZCuP8iNPcwtZAGyB9yMIoIbKGlR0vS1OBQq4JkVYEZA2whamRlZCla8eVYEEQPfa2WfNRyuAeqqqiYVLk3rhNXQr61lA7FWyfDPv9ZAOJtmSH2lF4SuzjQKlQuGSpIfC7hHFpaDAm0dQjbpX1HYw7AmIGNbXWAViKeU2iKNkEeijN8ZD",
}
@apiSuccessExample {json} Response-Example:
{
  "data": "user was deleted",
  "errors": []
}
###