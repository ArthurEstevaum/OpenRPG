import styles from "./MedievalButton.module.css"
import borderImage from "../../images/sec-button-medieval.png"

export default function MedievalButton() {
    return (
        <div className={styles.buttonWrapper}>
            <button className={styles.button}>
                <img src={borderImage} className={styles.border} />
                <p className={styles.buttonText}>Ver mais</p>
            </button>
        </div>
    )
}