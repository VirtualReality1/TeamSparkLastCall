import React, {PureComponent} from 'react';
import ReactDOM from "react-dom";
import ReactCrop from 'react-image-crop';
import 'react-image-crop/dist/ReactCrop.css';
import Modal from "../Views/Modal";

class ImageCrop extends PureComponent {
    state = {
        src: null,
        crop: {
            unit: '%',
            width: 100,
            aspect: 1,
        },
        showModal: false
    };

    hideModal = () => {
        this.setState({showModal: false})
    }
    showModal = () => {
        this.setState({showModal: true})
    }

    onSelectFile = e => {
        if (e.target.files && e.target.files.length > 0) {
            const reader = new FileReader();
            reader.addEventListener('load', () =>
                this.setState({src: reader.result})
            );
            reader.readAsDataURL(e.target.files[0]);
        }
    };

    onImageLoaded = image => {
        this.imageRef = image;
    };

    onCropComplete = crop => {
        this.makeClientCrop(crop);
    };

    onCropChange = (crop) => {
        this.setState({crop});
    };

    async makeClientCrop(crop) {
        if (this.imageRef && crop.width && crop.height) {
            const croppedImageUrl = await this.getCroppedImg(
                this.imageRef,
                crop,
                'newFile.jpeg'
            );
            this.setState({croppedImageUrl});
        }
    }

    getCroppedImg(image, crop, fileName) {
        const canvas = document.createElement('canvas');
        const scaleX = image.naturalWidth / image.width;
        const scaleY = image.naturalHeight / image.height;
        canvas.width = Math.ceil(crop.width * scaleX);
        canvas.height = Math.ceil(crop.height * scaleY);
        const ctx = canvas.getContext('2d');

        ctx.drawImage(
            image,
            crop.x * scaleX,
            crop.y * scaleY,
            crop.width * scaleX,
            crop.height * scaleY,
            0,
            0,
            crop.width * scaleX,
            crop.height * scaleY
        );

        return new Promise((resolve, reject) => {
            canvas.toBlob(blob => {
                if (!blob) {
                    console.error('Canvas is empty');
                    return;
                }
                blob.name = fileName;
                window.URL.revokeObjectURL(this.fileUrl);
                this.fileUrl = window.URL.createObjectURL(blob);
                resolve(this.fileUrl);
            }, 'image/jpeg', 1);
        });
    }

    render() {
        const {crop, croppedImageUrl, src, showModal} = this.state;
        console.log(croppedImageUrl)
        return (
            <div>
                <div className={'cursor-pointer flex flex-col items-center'} onClick={() => this.showModal()}>
                    <div className={'w-1/2 flex justify-center'}>
                        <img src={croppedImageUrl ? croppedImageUrl : '/uploads/project/default.jpg'}
                             alt="project-image" className={'w-full'}/>
                    </div>
                    <p className={'text-center underline mt-2'}>Bild ändern</p>
                </div>
                {showModal && (
                    <Modal hide={() => this.hideModal()}>
                        <div className={'my-16 text-center'}>
                            {src && (
                                <ReactCrop
                                    src={src}
                                    crop={crop}
                                    ruleOfThirds
                                    minWidth={30}
                                    minHeight={30}
                                    onImageLoaded={this.onImageLoaded}
                                    onComplete={this.onCropComplete}
                                    onChange={this.onCropChange}
                                    imageStyle={{maxHeight: '25rem'}}
                                />
                            )}
                            <div>
                                <label className={'cursor-pointer text-xl font-semibold underline'}>
                                    <input type="file" accept="image/*" onChange={this.onSelectFile}
                                           className={'hidden'}/>
                                    {src ? 'Bild ändern...' : 'Bild hochladen...'}
                                </label>
                            </div>
                        </div>
                    </Modal>
                )}
                <input type="text" className={'hidden'} name={'cropped-image'} defaultValue={croppedImageUrl}/>
            </div>
        );
    }
}

export default ImageCrop;

if (document.getElementById('image-upload')) {
    ReactDOM.render(<ImageCrop/>, document.getElementById('image-upload'));
}
