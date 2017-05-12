###
@apiVersion 1.0.0
@api {post} instagram/updateOrCreateUser updateOrCreateUser
@apiName updateOrCreateUser
@apiDescription api create or update user data used post parameters
@apiPermission none
@apiGroup instagram
@apiError instagramId not found "vkId not found"

@apiParam {integer} instagramId instagram user id
@apiParam {string} avatarUrl avatarUrl
@apiParam {string} name nickname from instagram
@apiParam {integer} photoLikes photo likes count
@apiParam {integer} videoLikes video likes count

@apiSuccess {String} data data
@apiParamExample {json} Request-Example:
{
  "instagramId" : "4112145",
  "avatarUrl" : "https://avatarurl",
  "name" : "mynickname7",
  "photoLikes" : "17",
  "videoLikes" : "81",
}
@apiSuccessExample {json} Response-Example:
{
  "data":200,
  "errors":[]
}
###