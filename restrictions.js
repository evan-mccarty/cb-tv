			const STATE_SETTINGS = 0;
			const STATE_DISPLAY = 1;
			const STATE_DISPLAY_STATIC = 2;
            const STATE_INITIAL = -1;
			var initiateRestrictionSettings = function(elem, obj){
				var buttons = elem.getElementsByTagName("button");
				obj.restrictions = [];
				obj.settings_div = elem;
				obj.settings_div.className="restrictions-hidden";
				/*for(var i = 0; i < buttons.length; i++){
					var button = buttons[i];
					var buttonType = button.dataset.buttonType;
					if(buttonType == "restriction"){
						var restriction = {button:button, text:button.dataset.restrictionText, added:false, paragraph:null};
						(function(button, obj2, len){
							button.addEventListener("click", function(event){
								handleRestrictionAdd(obj2, len);
							});
						}(button, obj, obj.restrictions.length));
						obj.restrictions[obj.restrictions.length] = restriction;
					}
					if(buttonType == "submit"){
						(function(button, obj2){
							button.addEventListener("click", function(event){
								handleSubmit(obj2);
							});
						}(button, obj));
						obj.submit = button;
					}
					if(buttonType == "clear"){
						(function(button, obj2){
							button.addEventListener("click", function(event){
								handleReset(obj2);
							});
						}(button, obj));
						obj.reset = button;
					}
				}*/
			}
            /*const SESSION_RESTRICTIONS = "restrictions.restrictions";
            const SESSION_STATE = "restrictions.state";
            var saveSessionState = function(restrictions){
                localStorage.setItem(SESSION_STATE, restrictions.state);
                var stateArray = [];
                for(var i = 0; i < restrictions.restrictions.length; i++){
                    var restriction = restrictions.restrictions[i];
                    if(restriction.added == true)
                        stateArray[stateArray.length] = restriction.text;
                }
                localStorage.setItem(SESSION_RESTRICTIONS, stateArray.length);
                for(var i = 0; i < stateArray.length; i++){
                    localStorage.setItem(convertToItemTag(SESSION_RESTRICTIONS, i), stateArray[i]);
                }
            }
            var loadSessionState = function(restrictions){
                var stateArray = [];
                var stateSize = localStorage.getItem(SESSION_RESTRICTIONS);
                if(stateSize != undefined){
                    for(var i = 0; i < stateSize; i++){
                        var stateDataItem = localStorage.getItem(convertToItemTag(SESSION_RESTRICTIONS, i));
                        stateArray[stateDataItem] = true;
                    }
                    for(var i = 0; i < restrictions.restrictions.length; i++){
                        var restriction = restrictions.restrictions[i];
                        if(stateArray[restriction.text] == true){
                            restrictions.restrictions[i].added = true;
                        }
                    }
                }
                var stateRestrictionsState = localStorage.getItem(SESSION_STATE);
                if(stateRestrictionsState == undefined){
                    restrictions.state = STATE_INITIAL;
                } else {
                    var idState = parseInt(stateRestrictionsState);
                    switch(idState){
                        case STATE_DISPLAY:
                            setDisplayState(restrictions);
                            break;
                        case STATE_DISPLAY_STATIC:
                            setDisplayStaticState(restrictions);
                            break;
                        case STATE_SETTINGS:
                            setDisplaySettings(restrictions);
                            break;
                        default:
                            restrictions.state = STATE_INITIAL;
                    }
                }
            }*/
            var convertToItemTag = function(tag, id){
                return tag + "_" + id;
            }
			var clearAdded = function(restrictions){
				var added = restrictions.added;
				for(var i = 0; i < restrictions.restrictions.length; i++){
					var restriction = restrictions.restrictions[i];
					if(restriction.paragraph != null){
						restriction.paragraph.parentNode.removeChild(restriction.paragraph);
						restriction.paragraph = null;
					}
				}
				for(display of restrictions.displays){
					display.population = false;
				}
				setStaticDisplayPopulation(restrictions);
				restrictions.displayIndex = 0;
				restrictions.displaySize = restrictions.displays[restrictions.displayIndex].size;
			}
			var initiateRestrictionDisplay = function(elem, obj){
				if(obj.displays == undefined)
					obj.displays = [];
				var delay = elem.dataset.timeoutDelay;
				if(delay == undefined)
					delay = 5000;
				else
					delay = parseInt(delay, 10);
				/*(function(elem2, obj2){
					elem2.addEventListener("click", function(){
						handleDisplayClick(obj2);
					})
				}(elem, obj));*/
				obj.displays[obj.displays.length] = {
					div:elem, size:parseInt(elem.dataset.restrictionsSize, 10), delay:delay, population:false
				}
			}
			var cancelUpdateTimeout = function(restrictions){
				clearTimeout(restrictions.interval);
			}
			/*var handleSubmit = function(restrictions){
				//clearAdded(restrictions);
				//addDisplayItems(restrictions);
				setDisplayState(restrictions);
                saveSessionState(restrictions);
			}*/
            var addDisplayItems = function(restrictions){
                var displayIndex = 0;
				var displaySize = restrictions.displays[displayIndex].size;
				for(var i = 0; i < restrictions.restrictions.length; i++){
					var restriction = restrictions.restrictions[i];
					if(restriction.added){
						displaySize--;
						if(displaySize <= 0){
							displayIndex++;
							if(displayIndex > restrictions.displays.length - 1){
								console.log("out of new displays, adding to last one");
								displayIndex--;
							}
							displaySize = restrictions.displays[displayIndex].size;
						}
						if(!restrictions.displays[displayIndex].population)
							restrictions.displays[displayIndex].population = true;
						var paragraph = document.createElement("p");
						paragraph.innerText = restriction.text;
						restrictions.displays[displayIndex].div.appendChild(paragraph);
						restriction.paragraph = paragraph;
						restrictions.restrictions[i] = restriction;
					}
				}
            }
			var handleTimerEvent = function(restrictions){
				var timeoutDelay = restrictions.displays[restrictions.intervalIndex].delay;
				(function(obj2, d2){
					obj2.interval = setTimeout(function(){
						handleTimerEvent(obj2);
					}, d2);
				}(restrictions, timeoutDelay));
				updateDisplayShow(restrictions);
				increaseIntervalIndex(restrictions);
				while(!restrictions.displays[restrictions.intervalIndex].population){
					increaseIntervalIndex(restrictions);
				}
			}
			var setStaticDisplayPopulation = function(restrictions){
				restrictions.displays[restrictions.staticDisplayIndex].population = true;
			}
			var increaseIntervalIndex = function(restrictions){
				restrictions.intervalIndex = (restrictions.intervalIndex + 1) % restrictions.displays.length;
			}
			/*var handleDisplayClick = function(restrictions){
				setSettingState(restrictions);
			}*/
			var setDisplayState = function(restrictions){
                clearAdded(restrictions);
                addDisplayItems(restrictions);
				var added = false;
				for(var i = 0; i < restrictions.restrictions.length; i++){
					var restriction = restrictions.restrictions[i];
					if(restriction.added){
						added = true;
						break;
					}
				}
				if(!added){
					setDisplayStaticState(restrictions);
				}else{
					restrictions.state = STATE_DISPLAY;
					restrictions.settings_div.className = "restrictions-hidden";
					restrictions.intervalIndex = 0;
					handleTimerEvent(restrictions);
				}
			}
			var setDisplayStaticState = function(restrictions){
				cancelUpdateTimeout(restrictions);
                restrictions.state = STATE_DISPLAY_STATIC;
				restrictions.settings_div.className = "restrictions-hidden";
				restrictions.intervalIndex = restrictions.staticDisplayIndex;
				updateDisplayShow(restrictions);
			}
			var updateDisplayShow = function(restrictions){
				for(var i = 0; i < restrictions.displays.length; i++){
					var display = restrictions.displays[i];
					if(i == restrictions.intervalIndex)
						display.div.className = "restrictions-show";
					else
						display.div.className = "restrictions-hidden";
				}
			}
			/*var setSettingState = function(restrictions){
				cancelUpdateTimeout(restrictions);
				restrictions.state = STATE_SETTINGS;
				restrictions.settings_div.className = "restrictions-show";
				for(var i = 0; i < restrictions.displays.length; i++){
					var display = restrictions.displays[i];
					display.div.className = "restrictions-hidden";
				}
			}
			var handleReset = function(restrictions){
				clearAdded(restrictions);
				for(var i = 0; i < restrictions.restrictions.length; i++){
					var restriction = restrictions.restrictions[i];
					restriction.added = false;
				}
				setDisplayStaticState(restrictions);
                saveSessionState(restrictions);
			}*/
			var handleRestrictionAdd = function(restrictions, index){
				restrictions.restrictions[index].added = !restrictions.restrictions[index].added;
			}
			var containsIndex = function(restrictions, index){
				for(var i = 0; i < restrictions.added.length; i++){
					var add = restrictions.added[i];
					if(add.index == index)
						return i;
				}
				return -1;
			}
			var initiateRestrictionStates = function(){
				var restrictionsnodes = document.getElementsByClassName("restrictions");
				for(var i = 0; i < restrictionsnodes.length; i++){
					var restrictions = restrictionsnodes[i];
					var restrictions_obj = new Object();
					restrictions_obj.restrictions = [];
					var restrictions_states = restrictions.children;
					for(var i2 = 0; i2 < restrictions_states.length; i2++){
						var restrictions_state = restrictions_states[i2];
						if(restrictions_state.dataset.restrictionsType == "settings")
							initiateRestrictionSettings(restrictions_state, restrictions_obj);
						if(restrictions_state.dataset.restrictionsType == "display")
							initiateRestrictionDisplay(restrictions_state, restrictions_obj);
					}
					restrictions_obj.added = [];
					restrictions_obj.staticDisplayIndex = 0;
					restrictions_obj.intervalIndex = 0;
					setDisplayStaticState(restrictions_obj);
					startRestictionsUpdate(restrictions_obj);
					//setSettingState(restrictions_obj);
				}
                //loadSessionState(restrictions_obj);
                //if(restrictions_obj.state == STATE_INITIAL)
                //    setSettingState(restrictions_obj);
			}
			var startRestictionsUpdate = function(restrictions){
				(function(res){
					getRestrictions(res);
					window.setInterval(function(){
						getRestrictions(res);
					}, 5000);
				})(restrictions);
			}
			var getRestrictions = function(restrictions){
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4) {
				       handleRestrictionsResponse(restrictions, this, xhttp);
				       //console.log(xhttp.getResponseHeader("Last-Modified"));
				    }
				};
				xhttp.open("GET", "getrestrictions.php", true);
				if(restrictions.updatetime != undefined && restrictions.updatetime != null){
					//url += "?updatetime=" + restrictions.updatetime;
					xhttp.setRequestHeader("If-Modified-Since", restrictions.updatetime);
				}
				xhttp.send();


			}
			var handleRestrictionsResponse = function(res, that, xhttp){
				if(that.status == 200){
					var restrictionsList = null;
					try{
						restrictionsList = JSON.parse(that.responseText);
					}catch(err){
						console.log("Problem with json file " + that.responseText);
					}
					//var responseInformation = restrictionsList[restrictionsList.length - 1];
					//var sendData = responseInformation["send"];
					res.updatetime = xhttp.getResponseHeader("Last-Modified");

					//console.log("ok");
					clearAdded(res);
					cancelUpdateTimeout(res);
					res.restrictions = [];
					var added = false;
			        for(var i = 0; i < restrictionsList.length; i++){
			        	var resterp = restrictionsList[i];
			        	for(var i2 = 0; i2 < resterp.length; i2++){
			        		var flerper = resterp[i2];
			        		if(flerper["enabled"] == "1")
			        			added = true;
			        		//console.log(flerper["display_text"]);
			        		var restrictionsflerp = {text:flerper["display_text"], added:(flerper["enabled"] == "1")}
			        		res.restrictions[res.restrictions.length] = restrictionsflerp;
			        		//console.log(flerper["title"] + "," + flerper["button_text"]);
			        	}
			        }
			        if(added){
			        	setDisplayState(res);
			        }
			        else{
			        	setDisplayStaticState(res);
			        }
				}

				if(that.status == 304){
					//console.log("already up to date");
				}
				//console.log(res.updatetime);

			}
			window.addEventListener("load", initiateRestrictionStates);