import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Modal from "../Views/Modal";

class Feedback extends Component {
    constructor(props) {
        super(props);
        this.state = {
            showModal: false,
            titleLength: 0,
            descriptionLength: 0
        }
    }

    hideModal() {
        this.setState({
            showModal: false
        })
    }

    showModal() {
        this.setState({
            showModal: true
        })
    }

    showTitleWarning() {
        const length = this.state.titleLength
        if (length > 0 && length < 3 || length > 255)
            return true
        return false
    }

    showDescriptionWarning() {
        const length = this.state.descriptionLength
        if (length > 0 && length < 3 || length > 30000)
            return true
        return false
    }

    modal() {
        return (
            <Modal hide={() => this.hideModal()}>
                <p className={'text-center mt-2 text-3xl tracking-wider font-semibold'}>Feedback</p>
                <form action="/feedback" method={'POST'}>
                    <input type="hidden" name="_token" value={this.props.csrf}/>
                    <div className={'px-4 mt-4 text-center'}>
                        <label htmlFor={'title'} className={'font-semibold'}>Titel</label>
                        <input type="text" id={'title'}
                               name={'title'}
                               className={'w-full border-2 border-secondary rounded-lg py-2 px-2 focus:outline-none focus:border-primary'}
                               required
                               onChange={(e) => this.setState({titleLength: e.target.value.length})}
                        />
                        {this.showTitleWarning() &&
                        <p className={'text-sm text-danger'}>3-255 Zeichen lang.</p>}
                    </div>
                    <div className={'px-4 mt-4 text-center'}>
                        <label htmlFor={'description'} className={'font-semibold'}>Beschreibung</label>
                        <textarea id={'description'}
                                  name={'description'}
                                  className={'w-full h-64 border-2 border-secondary rounded-lg py-2 px-2 focus:outline-none focus:border-primary'}
                                  required
                                  onChange={(e) => this.setState({descriptionLength: e.target.value.length})}
                                  placeholder={'Schreib uns dein Feedback zu unserer Website. Dies kann deine Gedanken zum Aufbau, Layout, der Navigation und allgemeinen Benutzerfreundlichkeit der Website beinhalten. Wir sind dir für deine ehrliche Meinung dankbar!\n' +
                                  '- Dein Teamspark Team'}
                        />
                        {this.showDescriptionWarning() &&
                        <p className={'text-sm text-danger'}>3-30.000 Zeichen lang.</p>}
                    </div>
                    <div className={'px-4 mt-4 text-center'}>
                        <input type="mail" id={'mail'}
                               name={'mail'}
                               className={'w-full border-2 border-secondary rounded-lg py-2 px-2 focus:outline-none focus:border-primary'}
                               placeholder={'E-Mail (optional)'}/>
                    </div>
                    <div className="px-4 mt-4">
                        <input className="mr-2 leading-tight" type="checkbox" name="consent" required/>
                        <span className="text-sm">{this.props.consent}</span>
                    </div>
                    <div className={'text-center my-4'}>
                        <button type={'submit'}
                                className={'border-secondary border-2 rounded-lg px-4 py-2 bg-secondary text-primary focus:outline-none'}>Abschicken
                        </button>
                    </div>
                </form>
            </Modal>
        )
    }

    render() {
        return (
            <div>
                <button
                    className={'px-4 py-2 uppercase leading-none w-full border-2 rounded-lg border-danger text-danger hover:border-secondary hover:text-secondary mt-4 lg:mt-0 lg:mr-4 focus:outline-none'}
                    onClick={() => this.showModal()}
                >Feedback
                </button>
                {this.state.showModal && this.modal()}
            </div>
        );
    }
}

export default Feedback;

if (document.getElementById('feedback')) {
    const csrf = document.getElementById('feedback').dataset.csrf
    const consent = document.getElementById('feedback').dataset.consent
    ReactDOM.render(<Feedback csrf={csrf} consent={consent}/>, document.getElementById('feedback'));
}
