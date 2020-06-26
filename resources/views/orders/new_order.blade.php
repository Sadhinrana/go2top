<div id="vueHolder">
    <form action="{{url('make_new_order')}}" method="post"  id="order-form-gotop" class="has-validation-callback">
       @csrf
       <div class="form-group">
          <label for="orderform-category">Category:</label>
          <select class="form-control" id="category_id" name="category_id" @change="categoryChanges">
             <option value="">Select a Category</option>
             @foreach($categories as $category)
             <option value="{{$category->id}}">{{$category->name}}</option>
             @endforeach
          </select>
       </div>
       <div class="form-group">
          <label for="orderform-service">Service: </label>
          <select class="form-control" id="service_id" name="service_id" v-model="service_id">
             <div v-if="services.length !== 0">
                <option value="">Select a service</option>
                <option v-for="serv in services" :value="serv.id"> @{{ serv.name }}</option>
             </div>
          </select>
          <input type="hidden" name="service_mode" v-model="service_mode" >
       </div>
       <div class="description hidden fields" id="service_description">
          <div class="service-description-split"></div>
       </div>
       <div class="description">
          <div class="form-group">
             <label for="description" class="control-label">Details: 📝 (Read before order)</label>
             <div v-html="serviceDesc" readonly style="height: 250px; overflow-y: scroll"  class="form-control"></div>
             {{-- <textarea readonly name="description"  id="description" rows="5" style="height: 250px"  class="form-control"></textarea> --}}
          </div>
       </div>
       <div class="form-group  fields" id="order_link">
          <label class="control-label" for="field-orderform-fields-link">Link: 📌 (Must be public) </label>
          <input class="form-control" name="link" value="" type="text" id="link">
       </div>
       {{-- all the optional fields --}}
       <div class="description" v-if="comments_visible">
          <div class="form-group">
             <label for="comments" class="control-label">Comments: (1 per line)</label>
             <textarea  name="text_area_1" @keydown='countPerLine' id="comments" rows="5" style="height: 250px" class="form-control" placeholder="comments"></textarea>
          </div>
       </div>
       <div class="description" v-if="keyword_visible">
          <div class="form-group">
             <label for="keywords" class="control-label">Keywords: (1 per line)</label>
             <textarea  name="text_area_1" @keydown='countPerLine' id="keywords" rows="5" style="height: 250px" class="form-control" placeholder="Key words"></textarea>
          </div>
       </div>
       <div class="description" v-if="perline_username_visible">
          <div class="form-group">
             <label for="keywords" class="control-label">Username: (1 per line)</label>
             <textarea  name="text_area_1" @keydown='countPerLine' id="per_line_username" rows="5" style="height: 250px" class="form-control" placeholder="Username per line"></textarea>
          </div>
       </div>
       <div class="description" v-if="hastags_visible">
          <div class="form-group">
             <label for="hastags" class="control-label">Hastags: (1 per line)</label>
             <textarea  name="text_area_2" id="hastags" rows="5" style="height: 250px" class="form-control" placeholder="Hastags"></textarea>
          </div>
       </div>
       <div class="form-group  fields" v-if="additional_username_visible" >
          <label class="control-label" for="field-orderform-fields-link">Username: </label>
          <input class="form-control" name="additional_inputs" value="" type="text" id="username">
       </div>
       <div class="form-group  fields" v-if="additional_email_visible">
          <label class="control-label" for="field-orderform-fields-link">Email: </label>
          <input class="form-control" name="additional_inputs" value="" type="text" id="email">
       </div>
       <div class="form-group  fields" v-if="additional_comment_owner_username_visible">
          <label class="control-label" for="field-orderform-fields-link">Username of the comment owner </label>
          <input class="form-control" name="additional_inputs" value="" type="text" id="owner_username">
       </div>
       <div class="form-group  fields"  v-if="additional_hashtags_visible">
          <label class="control-label" for="field-orderform-fields-link">Hashtag</label>
          <input class="form-control" name="additional_inputs" value="" type="text" id="hashtag">
       </div>
       <div class="form-group  fields" v-if="additional_media_url_visible">
          <label class="control-label" for="field-orderform-fields-link">Media URL</label>
          <input class="form-control" name="additional_inputs" value="" type="text" id="media_url">
       </div>
       <div class="form-group  fields" v-if="additional_answer_number_visible" >
          <label class="control-label" for="field-orderform-fields-link">Answer Number</label>
          <input class="form-control" name="additional_inputs" value="" type="text" id="answer_number">
       </div>
       {{-- all the optional fields ends --}}
       <div class="form-group  fields" id="order_quantity">
          <label class="control-label" for="field-orderform-fields-quantity">Quantity: 🔢</label>
          <input class="form-control" :class="{ 'input-disabled' : inputDisable}" name="quantity" v-model="quantity" type="number">
       </div>
       <div class="order_quantity_validation" v-if="quantity_validation">
            <p class="text-danger">@{{quantity_validation_msg}}</p>
       </div>
       {{--        drip feeed--}}
       <div class="form-group" id="drip_feed" v-if="drip_feed_available">
          <input type="checkbox" v-model="drip_feed" id="exampleCheck1"  name="drip_feed">
          <label class="form-check-label" for="exampleCheck1">Drip-feed</label>
       </div>
       <div id="drip_field" class="" v-if="drip_feed_content">
          <div class="form-group  fields" id="order_runs">
             <label class="control-label" for="field-orderform-fields-runs">Runs: </label>
             <input class="form-control" name="runs" v-model="runs" type="number">
          </div>
          <div class="form-group  fields" id="order_interval">
             <label class="control-label" for="field-orderform-fields-interval">Interval (minutes): </label>
             <input class="form-control" name="interval" v-model="interval"  type="number">
          </div>
          <div class="form-group  fields" id="order_total_quantity">
             <label class="control-label" for="field-orderform-fields-total_quantity">Total quantity: </label>
             <input class="form-control" name="total_quantity"  v-model="total_quantity" type="number" >
          </div>
       </div>
       {{--            end drip feed--}}
       <div class="form-group">
          <div class="card card-mini price bg-light">
             <div class="card-body">
                <span class="card-text">
                <b>Charge: 💰</b></span>
                <p>$<span id="order_total">@{{ charge }}</span></p>
                <input type="hidden" name="charge" :value="charge">
                <p id="not-enough-funds" style="display:none;color:red">Order amount exceeds available funds</p>
             </div>
          </div>
          <small class="help-block min-max">Min: <span id="min-q">@{{min}}</span> - Max: <span id="max-q">@{{max}}</span></small>
       </div>
       <div class="form-group" id="custom-comments-div" style="display: none">
          <label for="custom_comments" class="control-label">Custom Data</label>
          <textarea class="form-control" id="custom_comments" style="height: 150px;" placeholder="1 on each line" name="custom_comments"></textarea>
       </div>
       <div class="form-group">
          <button class="btn btn-blue" id="btn-proceed" type="submit">Submit</button>
       </div>
    </form>
 </div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>

    const NewOrder = new Vue({
        el: '#vueHolder',
        data: {
            categoryjs : [],
            category_id: null,
            service_id: null,
            price: null,
            services: [],
            serviceDesc: '',
            quantity: 0,
            min: 0,
            max: 0,
            drip_feed_available: false,
            drip_feed: false,
            drip_feed_content: false,
            runs: null,
            interval: null,
            total_quantity: 0,
            quantity_validation:false,
            quantity_validation_msg: '',
            service_mode:null,
            keyword_visible: false,
            comments_visible: false,
            hastags_visible: false,
            perline_username_visible: false,
            additional_username_visible: false,
            additional_email_visible: false,
            additional_media_url_visible: false,
            additional_comment_owner_username_visible: false,
            additional_answer_number_visible: false,
            additional_hashtags_visible: false,
            inputDisable: false,
        },
        computed: {
          charge(){
              if (this.drip_feed && this.runs !== null)
              {
                  return ((this.price / 1000 * this.quantity) * this.runs).toFixed(2);
              }
              else
              {
                  return (this.price / 1000 * this.quantity).toFixed(2);
              }

          }
        },
        watch:{
            category_id(newval, oldval)
            {
                if(newval !== null)
                {
                    let services = this.categoryjs.find(item => item.id == newval);

                    if(services !== null)
                    {
                        this.services = services.services;
                    }

                }
            },
            service_id(newval, oldval)
            {
                if (newval !== null)
                {
                    let serviceObj = this.services.find(item => item.id == newval);
                    if (serviceObj !== undefined) {
                        this.serviceDesc = serviceObj.description ?? '';
                    this.min = serviceObj.min_quantity ?? 0;
                    this.max = serviceObj.max_quantity ?? 0;
                    this.price = serviceObj.price ?? 0;
                    this.service_mode = serviceObj.mode ?? 0;
                    if (serviceObj.drip_feed_status === 'allow')
                    {
                        this.drip_feed_available  = true;
                    }

                    this.keyword_visible=false;
                    this.comments_visible=false;
                    this.hastags_visible=false;
                    this.perline_username_visible=false;
                    this.additional_username_visible=false;
                    this.additional_email_visible=false;
                    this.additional_media_url_visible=false;
                    this.additional_comment_owner_username_visible=false;
                    this.additional_answer_number_visible=false;
                    this.additional_hashtags_visible=false;
                    this.inputDisable=false;
                    console.log(serviceObj.service_type);
                    


                    /* extra fields condition */
                    if (serviceObj.service_type == 'SEO') 
                    {
                        this.keyword_visible= true; 
                    }
		            else if (serviceObj.service_type == 'SEO2') 
                    {
                        this.keyword_visible= true;
                        this.additional_email_visible=true;
                    }
		            else if (serviceObj.service_type == 'Default')
		            {
                        console.log('do nothing');
        		    }
              	    else if (serviceObj.service_type == 'Custom Comments')
		            {   
                        this.comments_visible = true;
                        this.inputDisable = true;
                    }
                    else if (serviceObj.service_type == 'Custom Comments Package')
                    {
                        this.inputDisable = true;
                        this.comments_visible = true;
                    }
                    else if (serviceObj.service_type == 'Comment Likes')
                    {
                        this.additional_comment_owner_username_visible = true;
                    }
		            else if (serviceObj.service_type == 'Mentions')
        		    {
                        this.perline_username_visible = true;
    		        }
                    else if (serviceObj.service_type == 'Mentions with Hashtags')
        		    {
                        this.inputDisable = true;
                        this.perline_username_visible = true;
                        this.hastags_visible = true;
		            }
                    else if (serviceObj.service_type == 'Mentions Custom List')
		            {
                        this.inputDisable = true;
                        this.perline_username_visible = true;
		            }
                    else if (serviceObj.service_type == 'Mentions Hashtag')
		            {
                        this.additional_hashtags_visible = true;
		            }
                    else if (serviceObj.service_type == 'Mentions Users Followers')
		            {
                        this.additional_username_visible = true;
		            }
                    else if (serviceObj.service_type == 'Mentions Media Likers')
		           {
                        this.additional_media_url_visible = true;
              	    }
                    else if (serviceObj.service_type == 'Package')
		            {
                        //everything should be invisible
		            }
                    else if (serviceObj.service_type == 'Poll')
                    {
                            this.additional_answer_number_visible = true;
                    }
                    else if (serviceObj.service_type == 'Comment Replies')
                    {
                        this.inputDisable = true;
                        this.comments_visible = true;
                        this.additional_username_visible = true;
                    }
                    else if (serviceObj.service_type == 'Invites From Groups')
                        {
                            //make group option visible
                        }
                    }
                    
 
                }
            },
            drip_feed(newval, oldval)
            {
                if (newval)
                {
                    this.drip_feed_content = true;
                }
                else
                {
                    this.drip_feed_content = false;
                }
            },
            quantity(newval, oldval)
            {
                if (this.drip_feed && this.runs !== null)
                {
                    this.total_quantity =  (this.quantity * this.runs);
                }
                
               if (newval < this.min || newval > this.max) {
                  this.quantity_validation = true;
                  this.quantity_validation_msg = "Quantity Limit exceeds , Min = "+this.min+" max = "+this.max;
               }
               else
               {
                  this.quantity_validation = false;
                  this.quantity_validation_msg = " ";
               } 
            },
            runs(newval, oldval)
            {
                if (this.drip_feed && this.runs !== null)
                {
                    this.total_quantity =  (this.quantity * this.runs);
                }
            },
        },
        created () {
            this.categoryjs =  <?= json_encode($categories)?>;
        },
        methods: {
            categoryChanges(evt){
                console.log(evt.target.value);
                this.category_id = evt.target.value;
            },
            countPerLine(evt)
            {
                if (this.inputDisable) {
                    if (evt.target.value.length > 0) {
                        let d = evt.target.value.split(/\r\n|\r|\n/).length;
                        this.quantity = d;
                    }
                    else
                    {
                        this.quantity = 0;
                    }    
                }
                
            }
        },
    });

</script>
