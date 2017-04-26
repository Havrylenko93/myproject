###
@apiVersion 1.0.0
@api {post} vk/deleteUser  deleteUser
@apiName deleteUser
@apiDescription api deleting user by token
@apiGroup vk

@apiParam {String} token vk token

@apiSuccess {String} msg user was deleted
@apiParamExample {json} Request-Example:
{
	"token" : "4cc7312070e302e62734c6092ebe440e45b54184195d0e386eca305e6095801416c015107243e9bc36d9c",
}
@apiSuccessExample {json} Response-Example:
{
  "data": "user was deleted",
  "errors": []
}
###