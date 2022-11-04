<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\Post\PostServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Get all posts",
     *     tags={"Post"},
     *     security={{"bearearAuth"={}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/PostResource"),
     *              ),
     *              @OA\Property(
     *                  property="links",
     *                  title="Links",
     *                  type="object",
     *                  description="Pagination links",
     *                  @OA\Property(
     *                      property="first",
     *                      title="First",
     *                      type="string",
     *                      description="First page link",
     *                      example="https://site.com/?page=1"
     *                  ),
     *                  @OA\Property(
     *                      property="last",
     *                      title="Last",
     *                      type="string",
     *                      description="Last page link",
     *                      example="https://site.com/?page=3"
     *                  ),
     *                  @OA\Property(
     *                      property="prev",
     *                      title="Prev",
     *                      type="string",
     *                      description="Previous page link. Can be null if currenct link is first.",
     *                      example="https://site.com/?page=1",
     *                      nullable=true
     *                  ),
     *                  @OA\Property(
     *                      property="next",
     *                      title="Next",
     *                      type="string",
     *                      description="Next page link. Can be null if currenct link is last.",
     *                      example="https://site.com/?page=3",
     *                      nullable=true
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="meta",
     *                  title="Meta",
     *                  type="object",
     *                  description="Meta information",
     *                  @OA\Property(
     *                      property="current_page",
     *                      title="Current Page",
     *                      type="int",
     *                      description="Current page number",
     *                      example="2"
     *                  ),
     *                  @OA\Property(
     *                      property="last_page",
     *                      title="Last Page",
     *                      type="int",
     *                      description="Last page number",
     *                      example="3"
     *                  ),
     *                  @OA\Property(
     *                      property="from",
     *                      title="From",
     *                      type="int",
     *                      description="First item on pahe number",
     *                      example="16"
     *                  ),
     *                  @OA\Property(
     *                      property="to",
     *                      title="To",
     *                      type="int",
     *                      description="Last item on pahe number",
     *                      example="30"
     *                  ),
     *                  @OA\Property(
     *                      property="total",
     *                      title="Total",
     *                      type="int",
     *                      description="Total items number",
     *                      example="45"
     *                  ),
     *                  @OA\Property(
     *                      property="per_page",
     *                      title="Per Page",
     *                      type="int",
     *                      description="Items per page number",
     *                      example="15"
     *                  ),
     *                  @OA\Property(
     *                      property="path",
     *                      title="Path",
     *                      type="string",
     *                      description="Base url path",
     *                      example="https://site.com"
     *                  ),
     *                  @OA\Property(
     *                      property="links",
     *                      title="Links",
     *                      type="array",
     *                      description="Pagination pages links",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(
     *                              property="url",
     *                              title="Url",
     *                              type="string",
     *                              description="Page url",
     *                              example="https://site.com/?page=1"
     *                          ),
     *                          @OA\Property(
     *                              property="label",
     *                              title="Label",
     *                              type="string",
     *                              description="Pagination link label",
     *                              example="Previous"
     *                          ),
     *                          @OA\Property(
     *                              property="active",
     *                              title="Active",
     *                              type="boolean",
     *                              description="Is the link is current",
     *                              example="false"
     *                          ),
     *                      ),
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response=404, ref="#/components/responses/BaseNotFoundResponse"),
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::with('user')->paginate(Post::COUNT_PER_PAGE));
    }

    /**
     * @param PostStoreRequest $request
     * @param PostServiceInterface $postService
     * @return PostResource
     * @OA\Post(
     *     path="/api/posts",
     *     summary="Add post",
     *     tags={"Post"},
     *     security={{"bearearAuth"={}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/PostStoreRequest")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Success",
     *         @OA\JsonContent(allOf={
     *             @OA\Schema(@OA\Property(property="data", ref="#/components/schemas/PostResource")),
     *             @OA\Schema(ref="#/components/schemas/BaseResponseSchema")
     *         })
     *     ),
     *     @OA\Response(response=422, ref="#/components/responses/ValidationFailedResponse"),
     * )
     */
    public function store(PostStoreRequest $request, PostServiceInterface $postService): PostResource
    {
        $post = $postService->create($request->user(), $request->getDto());
        return (new PostResource($post))->additional([
            'message' => trans('messages.post.created'),
        ]);
    }

    /**
     * @param Post $post
     * @return PostResource
     *
     * @OA\Get(
     *     path="/api/posts/{post_id}",
     *     summary="Get post",
     *     tags={"Post"},
     *     security={{"bearearAuth"={}}},
     *     description="Get current authed user",
     *     @OA\Parameter(ref="#/components/parameters/PostIdInPath"),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(ref="#/components/schemas/PostResource")
     *     ),
     * )
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * @param Post $post
     * @param PostUpdateRequest $request
     * @param PostServiceInterface $postService
     * @return PostResource
     * @OA\Put(
     *     path="/api/posts/{post_id}",
     *     summary="Update post",
     *     tags={"Post"},
     *     security={{"bearearAuth"={}}},
     *     @OA\Parameter(ref="#/components/parameters/PostIdInPath"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/PostUpdateRequest")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(allOf={
     *             @OA\Schema(@OA\Property(property="data", ref="#/components/schemas/PostResource")),
     *             @OA\Schema(ref="#/components/schemas/BaseResponseSchema")
     *         })
     *     ),
     *     @OA\Response(response=422, ref="#/components/responses/ValidationFailedResponse"),
     * )
     */
    public function update(Post $post, PostUpdateRequest $request, PostServiceInterface $postService): PostResource
    {
        $post = $postService->update($post, $request->getDto());
        return (new PostResource($post))->additional([
            'message' => trans('messages.post.updated'),
        ]);
    }


    /**
     * @param Post $post
     * @param PostServiceInterface $postService
     * @return Response
     * @OA\Delete(
     *     path="/api/posts/{post_id}",
     *     summary="Delete post",
     *     tags={"Post"},
     *     security={{"bearearAuth"={}}},
     *     @OA\Parameter(ref="#/components/parameters/PostIdInPath"),
     *     @OA\Response(response=200, ref="#/components/responses/BaseResponse"),
     * )
     */
    public function destroy(Post $post, PostServiceInterface $postService): Response
    {
        $postService->delete($post);
        return \response([
            'message' => trans('messages.post.deleted'),
        ]);
    }
}
